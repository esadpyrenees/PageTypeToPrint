<?php
/* markdown-it-youtube-php 0.1.0 
 * https://github.com/gcdinsmore/markdown-it-youtube-php
 * Copyright (c) 2022 Glen Dinsmore <glen@saltygeek.com>
 * @license MIT 
 */

namespace Kaoken\MarkdownIt\Plugins;
use Kaoken\MarkdownIt\MarkdownIt;
use Kaoken\MarkdownIt\RulesInline\StateInline;

/**
 * YouTube inline markdown. Syntax is similar to image markdown:
 * !yt[label](sk2pr4XD_kw "title")
 *
 * The HTML uses the YouTube Player iframe APIs:
 * https://developers.google.com/youtube/iframe_api_reference
 */
class YoutubeIt {
	private string $width = "480px";
	private string $height = "270px";
	private ?string $origin = null;
	private ?string $clazz = null;

	private static $href_pattern = "/^(https\:\/\/|)(youtu\.be\/|www\.youtube\.com\/watch\?v\=|)(?<v>[\w|\d|\_|\-]+)$/";

	public function __construct($options = null) {
		if (isset($options)) {
			if (is_array($options)) $options = (object)$options;
			if (isset($options->{'width'})) { $this->width = $options->{'width'}; }
			if (isset($options->{'height'})) { $this->height = $options->{'height'}; }
			if (isset($options->{'origin'})) { $this->origin = $options->{'origin'}; }
			if (isset($options->{'class'})) { $this->clazz = $options->{'class'}; }
		}
	}

	/**
	 * Insert this plugin.
	 *
	 * @param MarkdownIt $md
	 */
	public function plugin(MarkdownIt $md){
		$md->inline->ruler->push( 'youtube', [$this, 'youtube'] );
	}

	/**
	 * Search for YoutubeIt markdown.
	 *
	 * @param StateInline $state
	 * @param boolean $silent
	 * @return bool
	 */
	public function youtube(StateInline &$state, $silent=false): bool
	{
		$href = '';
		$oldPos = $state->pos;
		$max = $state->posMax;

		if ($state->src[$state->pos] !== '!') { return false; }
		if (strlen($state->src) <= $state->pos+3 || $state->src[$state->pos + 1] !== 'y' || 
				$state->src[$state->pos + 2] !== 't' || $state->src[$state->pos + 3] !== '[') {
			return false; 
		}

		$labelStart = $state->pos + 4;
		$labelEnd = $state->md->helpers->parseLinkLabel($state, $state->pos + 3, false);

		// parser failed to find ']', so it's not a valid youtube
		if ($labelEnd < 0) { return false; }

		$pos = $labelEnd + 1;
		if ($pos < $max && $state->src[$pos] === '(') {
			//
			// Inline youtube
			//

			// !yt[label](  <$video>  "$title"  )
			//            ^^ skipping these spaces
			$pos++;
			for (; $pos < $max; $pos++) {
				$code = $state->src[$pos];
				if (!$state->md->utils->isSpace($code) && $code !== "\n") { break; }
			}
			if ($pos >= $max) { return false; }

			// !yt[label](  <$video>  "$title"  )
			//              ^^^^^^^^ parsing YouTube video id
			$start = $pos;

			$res = $state->md->helpers->parseLinkDestination($state->src, $pos, $state->posMax);
			if ($res->ok) {
				$href = $state->md->normalizeLink($res->str);
				if ($state->md->validateLink($href)) {
					$pos = $res->pos;
				} else {
					$href = '';
				}
			}

			// !yt[label](  <$video>  "$title"  )
			//                      ^^ skipping these spaces
			$start = $pos;
			for (; $pos < $max; $pos++) {
				$code = $state->src[$pos];
				if (!$state->md->utils->isSpace($code) && $code !== "\n") { break; }
			}

			// !yt[label](  <$video>  "$title"  )
			//                        ^^^^^^^^ parsing $title
			$res = $state->md->helpers->parseLinkTitle($state->src, $pos, $state->posMax);
			if ($pos < $max && $start !== $pos && $res->ok) {
				$title = $res->str;
				$pos = $res->pos;

				// !yt[label](  <$video>  "$title"  )
				//                                ^^ skipping these spaces
				for (; $pos < $max; $pos++) {
					$code = $state->src[$pos];
					if (!$state->md->utils->isSpace($code) && $code !== "\n") { break; }
				}
			} else {
				$title = '';
			}

			if ($pos >= $max || $state->src[$pos] !== ')') {
				$state->pos = $oldPos;
				return false;
			}
			$pos++;
		} else {
			//
			// Link reference
			//
			if ( !isset($state->env->references) ) { return false; }

			$label = false;
			if ($pos < $max && $state->src[$pos] === '[') {
				$start = $pos + 1;
				$pos = $state->md->helpers->parseLinkLabel($state, $pos);
				if ($pos >= 0) {
					$label = substr($state->src, $start, ($pos++)-$start);
				} else {
					$pos = $labelEnd + 1;
				}
			} else {
				$pos = $labelEnd + 1;
			}

			// covers $label === '' and $label === undefined
			// (collapsed reference link and shortcut reference link respectively)
			if (!$label) { $label = substr($state->src, $labelStart, $labelEnd-$labelStart); }

			$ref = false;
			$key = $state->md->utils->normalizeReference($label);
			if( isset($state->env->references) && array_key_exists($key, $state->env->references)){
				$ref = &$state->env->references[$key];
				if ($ref) {
					$href = $ref['href'];
					$title = $ref['title'];
				}
			}
			if( $ref === false ){
				$state->pos = $oldPos;
				return false;
			}
		}

		//
		// We found the end of the link, and know for a fact it's a valid link;
		// so all that's left to do is to call tokenizer.
		//
		if (!$silent) {
			$label = substr($state->src, $labelStart, $labelEnd-$labelStart);

			// In case the entire URL is present, pull just the video id
			if (!preg_match(self::$href_pattern, $href, $matches)) {
				$state->pos = $oldPos;
				return false;
			}
			$video = $matches['v'];
			$href = 'https://www.youtube.com/embed/' . $video;
			if (isset($this->origin)) { $href = $href . '?origin=' . $this->origin; }

			$tokens = [];
			$state->md->inline->parse(
				'',
				$state->md,
				$state->env,
				$tokens
			);
			$token           = $state->push('youtube_wrapper', 'div', 1);
			$token->attrs    = [ [ 'class', "video" ] ];
			$token           = $state->push('youtube', 'iframe', 1);
			$token->attrs    = [ [ 'src', $href ],
								[ 'width', $this->width ], [ 'height', $this->height ],
								[ 'allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' ],
								[ 'allowfullscreen', null ] ];
			$token->children = &$tokens;
			$token->attrs[]  = [ 'alt', $label ? $label : '' ];
			$token->attrs[]  = [ 'title', $title ? $title : 'YouTube video player' ];
			if ($this->clazz) {
				$token->attrs[]  = [ 'class', $this->clazz ];
			}
			// iframes require a close.
			$token           = $state->push('youtube_close', 'iframe', -1);
			$token           = $state->push('youtube_wrapper_close', 'div', -1);
		}

		$state->pos = $pos;
		$state->posMax = $max;
		return true;
	}
}
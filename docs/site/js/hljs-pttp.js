

hljs.registerLanguage(
  "pagetypetoprint",
  (function () {
    "use strict";
    return function (n) {
      const k = {
        attribute: "imagenote caption video figure poster class term image width printwidth col printcol",
        literal: "hljs-note",
        value: "offset0 offset2 offset4 offset6 offset8 quarter third half twothird threequarter full notwhite printleft printright",
        built_in: "glossary ¶¶¶ cap close complex copy imag len make new panic print println real recover delete",
      };
      const e = {
          begin: "<",
          end: ">",
          subLanguage: "xml",
          relevance: 0,
        },
        p = {
          begin: "\\[\\^",
          end: "\\]",
          className: "note",
          relevance: 0,
        },
        a = {
          begin: "\\[.+?\\][\\(\\[].*?[\\)\\]]",
          returnBegin: !0,
          contains: [
            {
              className: "string",
              begin: "\\[",
              end: "\\]",
              excludeBegin: !0,
              returnEnd: !0,
              relevance: 0,
            },
            {
              className: "link",
              begin: "\\]\\(",
              end: "\\)",
              excludeBegin: !0,
              excludeEnd: !0,
            },
            {
              className: "symbol",
              begin: "\\]\\[",
              end: "\\]",
              excludeBegin: !0,
              excludeEnd: !0,
            },
          ],
          relevance: 10,
        },
        i = {
          className: "strong",
          contains: [],
          variants: [
            { begin: /_{2}/, end: /_{2}/ },
            { begin: /\*{2}/, end: /\*{2}/ },
          ],
        },
        s = {
          className: "emphasis",
          contains: [],
          variants: [
            { begin: /\*(?!\*)/, end: /\*/ },
            // { begin: /_(?!_)/, end: /_/, relevance: 0 },
          ],
        };
      i.contains.push(s), s.contains.push(i);
      var c = [e, a, p];
      return (
        (i.contains = i.contains.concat(c)),
        (s.contains = s.contains.concat(c)),
        {
          name: "PageTypeToPrint",
          keywords: k,
          aliases: ["pttp", "pttpmd"],
          contains: [
            {
              className: "section",
              variants: [
                { begin: "^#{1,6}", end: "$", contains: (c = c.concat(i, s)) },
                {
                  begin: "(?=^.+?\\n[=-]{2,}$)",
                  contains: [
                    { begin: "^[=-]*$" },
                    { begin: "^", end: "\\n", contains: c },
                  ],
                },
              ],
            },
            e,
            {
              className: "bullet",
              begin: "^[ \t]*([*+-]|(\\d+\\.))(?=\\s+)",
              end: "\\s+",
              excludeEnd: !0,
            },
            i,
            s,
            { className: "quote", begin: "^>\\s+", contains: c, end: "$" },
            {
              className: "code",
              variants: [
                { begin: "(`{3,})(.|\\n)*?\\1`*[ ]*" },
                { begin: "(~{3,})(.|\\n)*?\\1~*[ ]*" },
                { begin: "```", end: "```+[ ]*$" },
                { begin: "~~~", end: "~~~+[ ]*$" },
                { begin: "`.+?`" },
                {
                  begin: "(?=^( {4}|\\t))",
                  contains: [{ begin: "^( {4}|\\t)", end: "(\\n)$" }],
                  relevance: 0,
                },
              ],
            },
            { begin: "^[-\\*]{3,}", end: "$" },
            a,
            p,
            {
              begin: /^\[[^\n]+\]:/,
              returnBegin: !0,
              contains: [
                {
                  className: "symbol",
                  begin: /\[/,
                  end: /\]/,
                  excludeBegin: !0,
                  excludeEnd: !0,
                },
                {
                  className: "link",
                  begin: /:\s*/,
                  end: /$/,
                  excludeBegin: !0,
                },
              ],
            },
          ],
        }
      );
    };
  })()
);

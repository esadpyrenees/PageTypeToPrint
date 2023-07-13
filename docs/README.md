# Documentation

La documentation est générée grâce à [MkDocs](https://www.mkdocs.org/), un générateur de site statique en python.

```sh
# Create a virtualenv
python -m venv /path/to/new/virtual/environment
# Activate the venc
source /path/to/new/virtual/environment/bin/activate
# Install MkDocs
pip install mkdocs
# CD the docs folder
cd /path/to/PageTypeToPrint/docs/
# Serve the live docs
mkdocs serve
# Or build it
mkdocs build
# Or deploy on github :)
mkdocs gh-deploy
```
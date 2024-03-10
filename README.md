# S

This is a storyboard compiler.

It compile shots and scenes stored in folters to a multi page website and PDF files.

It's supposed to work with [Krita](https://krita.org) for drawing the thumbnails.

Architecture
------------

    📁 src
        📁 <scene>
            📄 info.txt
            ❗ data.yml
            📁 <shot>
                📄 info.txt
                ❗ data.yml
                🖌️ a.kra
                🖌️ b.kra

Dependancies
------------

```
make php weasyprint poppler-utils imagemagick fswatch
```

All of those are packaged by Debian.

Commands
--------

### Build

```
make
```

Build the Web pages and PDF files to the `build` folder.

### Watch

```
make watch
```

Try to detect file changes to trigger building. This avoid building the PDF as it's the slowest task.

### Clean

```
make clean
```




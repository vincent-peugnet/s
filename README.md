# S

This is a storyboard compiler.

It compile shots and scenes stored in folters to a multi page website and PDF files.

It's supposed to work with [Krita](https://krita.org) for drawing the thumnails.

Architecture
------------

    📁 <scene>
        📄 info.txt
        📁 <shot>
            📄 info.txt
            🖼️ decor.jpg
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

### Watch

```
make watch
```

### Clean

```
make clean
```




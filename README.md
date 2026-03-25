# S

This is a storyboard compiler.

It compile shots and scenes stored in folters to a multi page website and PDF files.

It's supposed to work with [Krita](https://krita.org) for drawing the thumbnails.

More informations in this [presentation](https://246.eu/s-presentation).

Architecture
------------

    📁 src
        📁 <scene>
            ❗ data.yml
            🖌️ set.kra
            📁 <shot>
                ❗ data.yml
                🖌️ a.kra
                🖌️ b.kra

`data.yml` can use any custom key. But some of them are specifics:

- `info` key is rendered as text paragraph.
- in **scenes**, `effet` (night or day / indoor, outdoor) is displayed on the the scene index.
- in **shots**, `valeur`, `mouvement`, `focale`, `hauteur` are used in the shot list page.

### Syntax

The info key allow a syntax to target scenes and shots.

    SCENE/SHOT

Will create a link to a specific shot in a scene.

    SHENE/

Will create a link to a scene.

    ./SHOT

Will create a link to a given shot in the current scene.


Dependancies
------------

```
make php weasyprint poppler-utils imagemagick xmlstarlet fswatch
```

All of those are packaged by Debian.

Commands
--------

### Build

```
make
```

Build the Web pages and PDF files to the `build` folder. You can spkip PDF creation (which is slower) by using:

```
make html
```

### Watch

```
make watch
```

Try to detect file changes to trigger building process (excluding PDF).

### Clean

```
make clean
```



Thanks
------

- Special thanks to **Nicolas Peugnet** and his suspicious love for Makefiles ❤️.
- To the **Krita** team and community for this cool free software. (And thanks to [the KritaPy](https://github.com/ivyallie/KritaPy) repo who help me to figure out that `.kra` are zip files that already contain the PNG of merged Krita layers).
- To **Weasyprint**, even if it is a bit slow 🥲.
- And of course to the Debian team and whole UNIX ecosystem !

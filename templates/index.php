<?php
    $dir = $argv[1];
    $dirs =  array_diff(scandir($dir), array('..', '.')); 
    $scenes =  array_filter($dirs, function($dirname) use($dir): bool {
        return is_dir($dir . DIRECTORY_SEPARATOR . $dirname);
    });
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storyboard</title>
    <link rel="stylesheet" href="base.css">
</head>
<body>
    <h1>
        Storyboard
    </h1>
    <nav>
        <ul class="scenes">
            <?php foreach ($scenes as $scene) { ?>
                <li>
                    <a href="<?= $scene ?>/index.html">
                        <?= $scene ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </nav>
    <footer>
        <a href="index.pdf" download="storyboard.pdf" class="button">
            ⬇ download PDF
        </a>
        <p class="renderDate">
            Rendered at <?= date("Y-m-d H:i:s") ?>
        </p>
    </footer>
</body>
</html>

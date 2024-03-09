<?php
    $buildDir = $argv[1];
    $sceneName = basename($buildDir);
    $dirs =  array_diff(scandir($buildDir), array('..', '.')); 
    $shots =  array_filter($dirs, function($dirname) use($buildDir): bool {
        return is_dir($buildDir . DIRECTORY_SEPARATOR . $dirname);
    });
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scene <?= $sceneName ?></title>
    <link rel="stylesheet" href="../base.css">
</head>
<body>
<nav>
    <a href="../index.html">↖ back to scenes</a>
</nav>
<main class="scene">
    <h2>
        Scene <?= $sceneName ?>
    </h2>
    <p class="info">
        <?= is_file("$buildDir/info.txt") ? file_get_contents("$buildDir/info.txt") : '' ?>
    </p>
    <?php
        foreach ($shots as $shot) {
            $thumbnails = glob("$buildDir/$shot/*.webp");
    ?>  
        <div class="shot">
            <h3>
                Shot <?= $shot ?>
            </h3>
            <p class="info">
                <?= is_file("$buildDir/$shot/info.txt") ? file_get_contents("$buildDir/$shot/info.txt") : '' ?>
            </p>
            <div class="thumbnails">
                <?php foreach ($thumbnails as $thumbnail) { ?>
                    <img src="<?= $shot . '/' . basename($thumbnail) ?>" class="thumbnail" alt="">
                <?php } ?>
            </div>
        </div>
    <?php }?>
</main>
<footer>
    <a href="index.pdf" download="scene-<?= $sceneName ?>.pdf">
        ⬇ download PDF
    </a>
</footer>
</body>
</html>

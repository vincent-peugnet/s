<?php

    include('getData.php'); // gives us data(array $dir) function
    include('getScenes.php'); // gives us the $scenes var, a list of scene names
    require('autoLink.php'); // autoLink function

    $buildDir = $argv[2];
    $sceneName = basename($buildDir);
    $dirs =  array_diff(scandir($buildDir), array('..', '.')); 
    $shots =  array_filter($dirs, function($dirname) use($buildDir): bool {
        return is_dir($buildDir . DIRECTORY_SEPARATOR . $dirname);
    });
    $data = data($buildDir);

    $sceneImages =  array_filter($dirs, function($dirname) use($buildDir): bool {
        return is_file($buildDir . DIRECTORY_SEPARATOR . $dirname) && str_ends_with($dirname, '.jpg');
    });

    $sceneKey = array_search($sceneName, $scenes);
    $previousKey = $sceneKey - 1;
    $nextKey = $sceneKey + 1;
?>


<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Scene <?= $sceneName ?></title>
    <link rel="stylesheet" href="../base.css" />
</head>
<body>
<nav class="scene top">
    <ul>
        <li class="scenes">
            <a href="../index.html">☰ all scenes</a>
        </li>
        <li class="shots">
            <a href="../shotlist.html">☷ shot list</a>
        </li>
    </ul>
    <ul>
        <li class="previous">
            <?php if (isset($scenes[$previousKey])) { ?>
                <a href="<?= "../$scenes[$previousKey]/index.html" ?>"><?= $scenes[$previousKey] ?></a>
            <?php } ?>
        </li>
        <li class="next">
            <?php if (isset($scenes[$nextKey])) { ?>
                <a href="<?= "../$scenes[$nextKey]/index.html" ?>"><?= $scenes[$nextKey] ?></a>
            <?php } ?>
        </li>
    </ul>
</nav>
<main class="scene">
    <h2>
        Scene <?= $sceneName ?>
    </h2>
    <p class="info">
        <?= isset($data['info']) ? autoLink($data['info'], $sceneName, '..') : '' ?>
    </p>
    <?php
        unset($data['info']);
        include('dataTable.php');
    ?>
    <div class="attachment">
        <?php foreach ($sceneImages as $image) { ?>
            <img src="<?= basename($image) ?>" alt="" />
        <?php } ?>
    </div>
    <?php
        foreach ($shots as $shot) {
            $thumbnails = glob("$buildDir/$shot/*.jpg");
            $data = data("$buildDir/$shot");
    ?>  
        <div class="shot" id="<?= $shot ?>">
            <h3>
                Shot <?= $shot ?>
                <a href="#<?= $shot ?>">#</a>
            </h3>
            <p class="info">
                <?= isset($data['info']) ? autoLink($data['info'], $sceneName, '..') : '' ?>
            </p>
            <?php
                unset($data['info']); 
                include('dataTable.php');
            ?>
            <div class="thumbnails">
                <?php foreach ($thumbnails as $thumbnail) { ?>
                    <img src="<?= $shot . '/' . basename($thumbnail) ?>" class="thumbnail" alt="" />
                <?php } ?>
            </div>
        </div>
    <?php }?>
</main>
<nav class="scene bottom">
    <ul>
        <li class="previous">
            <?php if (isset($scenes[$previousKey])) { ?>
                <a href="<?= "../$scenes[$previousKey]/index.html" ?>"><?= $scenes[$previousKey] ?></a>
            <?php } ?>
        </li>
        <li class="next">
            <?php if (isset($scenes[$nextKey])) { ?>
                <a href="<?= "../$scenes[$nextKey]/index.html" ?>"><?= $scenes[$nextKey] ?></a>
            <?php } ?>
        </li>
    </ul>
</nav>
<footer>
    <a href="index.pdf" download="scene-<?= $sceneName ?>.pdf" class="button">
        ⬇ download scene PDF
    </a>
    <p class="renderDate">
        Rendered at <?= date("Y-m-d H:i:s") ?> with <a href="https://github.com/vincent-peugnet/s" target="_blank">*S*</a>
    </p>
</footer>
</body>
</html>

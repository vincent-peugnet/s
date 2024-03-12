<?php
    function data(string $dir) : array
    { 
        $data = [];
        if (is_file("$dir/data.yml")) {
            $lines = file("$dir/data.yml");

            foreach ($lines as $line) {
                $cols = explode(':', $line);
                $data[trim($cols[0])] = trim($cols[1]);
            }
        }
        return $data; 
    }

    include('getScenes.php');

    $buildDir = $argv[2];
    $sceneName = basename($buildDir);
    $dirs =  array_diff(scandir($buildDir), array('..', '.')); 
    $shots =  array_filter($dirs, function($dirname) use($buildDir): bool {
        return is_dir($buildDir . DIRECTORY_SEPARATOR . $dirname);
    });
    $data = data($buildDir);

    $sceneKey = array_search($sceneName, $scenes);
    $previousKey = $sceneKey - 1;
    $nextKey = $sceneKey + 1;
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scene <?= $sceneName ?></title>
    <link rel="stylesheet" href="../base.css">
</head>
<body>
<nav class="scene top">
    <ul>
        <li class="previous">
            <?php if (isset($scenes[$previousKey])) { ?>
                <a href="<?= "../$scenes[$previousKey]/index.html" ?>">« previous</a>
            <?php } ?>
        </li>
        <li class="menu">
            <a href="../index.html">≡ all scenes</a>
        </li>
        <li class="next">
            <?php if (isset($scenes[$nextKey])) { ?>
                <a href="<?= "../$scenes[$nextKey]/index.html" ?>">next »</a>
            <?php } ?>
        </li>
    </ul>
</nav>
<main class="scene">
    <h2>
        Scene <?= $sceneName ?>
    </h2>
    <p class="info">
        <?= is_file("$buildDir/info.txt") ? file_get_contents("$buildDir/info.txt") : '' ?>
    </p>
    <?php include('dataTable.php') ?>
    <?php
        foreach ($shots as $shot) {
            $thumbnails = glob("$buildDir/$shot/*.jpg");
            $data = data("$buildDir/$shot");
    ?>  
        <div class="shot">
            <h3>
                Shot <?= $shot ?>
            </h3>
            <p class="info">
                <?= is_file("$buildDir/$shot/info.txt") ? file_get_contents("$buildDir/$shot/info.txt") : '' ?>
            </p>
            <?php include('dataTable.php') ?>
            <div class="thumbnails">
                <?php foreach ($thumbnails as $thumbnail) { ?>
                    <img src="<?= $shot . '/' . basename($thumbnail) ?>" class="thumbnail" loading="lazy" alt="">
                <?php } ?>
            </div>
        </div>
    <?php }?>
</main>
<nav class="scene bottom">
    <ul>
        <li class="previous">
            <?php if (isset($scenes[$previousKey])) { ?>
                <a href="<?= "../$scenes[$previousKey]/index.html" ?>">« previous</a>
            <?php } ?>
        </li>
        <li class="menu">
            <a href="../index.html">≡ all scenes</a>
        </li>
        <li class="next">
            <?php if (isset($scenes[$nextKey])) { ?>
                <a href="<?= "../$scenes[$nextKey]/index.html" ?>">next »</a>
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

<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shot list</title>
    <link rel="stylesheet" href="base.css" />
</head>
<body>
    <nav class="top">
        <ul>
            <li>
                <a href="index.html">☰ all scenes</a>
            </li>
            <li>
                <a href="shotlist.html">☷ shot list</a>
            </li>
        </ul>
    </nav>
    <h1>
        Shot list
    </h1>
<table class="shotList">
    <tr>
        <th>
            shot
        </th>
        <th>
            valeur
        </th>
        <th>
            mouvement
        </th>
        <th>
            focale
        </th>
        <th>
            hauteur
        </th>
        <th>
            info
        </th>
        <th>
            lien
        </th>
    </tr>
    <?php

require('getScenes.php');
require('getData.php');
require('autoLink.php');
$shotCounter = 0;

foreach ($scenes as $scene) {
    ?>
    <tr>
        <td colspan="7" class="link scene">
            <a href="<?= $scene ?>/index.html">
                <?= $scene ?>
            </a>
        </td>
    </tr>
    <?php
    $sceneSrcDir = "$srcDir/$scene";
    $dirs =  array_diff(scandir($sceneSrcDir), array('..', '.')); 
    $shots =  array_filter($dirs, function($dirname) use($sceneSrcDir): bool {
        return is_dir($sceneSrcDir . DIRECTORY_SEPARATOR . $dirname);
    });
    foreach ($shots as $shot) {
        $shotCounter ++;
        $data = data("$sceneSrcDir/$shot");
        ?>
        <tr>
            <td>
                <?= $shot ?>
            </td>
            <td>
                <?= isset($data['valeur']) ? $data['valeur'] : '' ?>
            </td>
            <td>
                <?= isset($data['mouvement']) ? $data['mouvement'] : '' ?>
            </td>
            <td>
                <?= isset($data['focale']) ? $data['focale'] : '' ?>
            </td>
            <td>
                <?= isset($data['hauteur']) ? $data['hauteur'] : '' ?>
            </td>
            <td>
                <?= isset($data['info']) ? autoLink($data['info'], $scene, '.') : '' ?>
            </td>
            <td class="link">
                <a href="<?= $scene ?>/index.html#<?= $shot ?>">✦</a>
            </td>
        </tr>




        <?php
    }
}


?>
</table>
<p class="statistic">
    <?= $shotCounter ?> shots
</p>
</body>

</html>

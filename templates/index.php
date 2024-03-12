<?php
    include('getScenes.php');
    include('getData.php'); // gives us data(array $dir) function
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
                        <span class="name">
                            <?= $scene ?>
                        </span>
                        <?php $data = data("$srcDir/$scene") ?>
                        <span class="data situation">
                            <?= isset($data['situation']) ? $data['situation'] : '' ?>
                        </span>
                        <span class="data effet">
                            <?= isset($data['effet']) ? $data['effet'] : '' ?>
                        </span>
                        <span class="data info" title="<?= isset($data['info']) ? $data['info'] : '' ?>">
                            <?= isset($data['info']) ? $data['info'] : '' ?>
                        </span>
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
            Rendered at <?= date("Y-m-d H:i:s") ?> with <a href="https://github.com/vincent-peugnet/s" target="_blank">*S*</a>
        </p>
    </footer>
</body>
</html>

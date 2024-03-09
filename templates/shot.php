<div class="shot">
    <h3>
        Shot <?= $shot . PHP_EOL ?>
    </h3>
    <p class="info">
        <?= isset($shotData['info']) ? file_get_contents("src/$sequence/$shot.txt") : '' ?>
    </p>
    <div class="images">
        <?php
        if (isset($shotData['images'])) {
            foreach ($shotData['images'] as $image) {
                ?>
                    <img src="src/<?= $sequence ?>/<?= $image ?>">
                <?php
            }
        }
        ?>
    </div>
</div>

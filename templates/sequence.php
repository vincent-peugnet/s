<?php
$files = (scandir("./src/$sequence"));

$shots = [];
foreach ($files as $file) {
    if(boolval(preg_match('#^([0-9][0-9])[a-z]?\.(txt|png)$#', $file, $matches))) {
        switch ($matches[2]) {
            case 'txt':
                $shots[$matches[1]]['info'] = $matches[0];
                break;
            
            case 'png':
                $shots[$matches[1]]['images'][] = $matches[0];
                break;
        }
    }
}

?>


<div class="sequence">
    <h2>
        Sequence <?= $sequence . PHP_EOL ?>
    </h2>
    <?php


        foreach ($shots as $shot => $shotData) {
            include('shot.php');
        }
    ?>
</div>

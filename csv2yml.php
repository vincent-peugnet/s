<?php

/**
 * IMPORT CSV DATAS INTO SCENES DATA.YML FILES
 *
 * USAGE: php csv2yml.php CSV_FILENAME
 *
 * Create data.yml file in every corresponding directories.
 * Columns have to be : scene, effet, decor, info
 */

function sceneExist(string $number) : string {
    $number = strtolower($number);
    for ($i=0; $i < 3 ; $i++) {
        $zeros = str_repeat('0', $i);
        $sceneFolder = "src/$zeros$number";
        if(file_exists($sceneFolder)) {
            return $sceneFolder;
        }
    }
    return "";
}

$file = $argv[1]; // filename is argument.
$scenes = array_map(function($line) : array {
    $vals = str_getcsv($line);
    return [
        'number' => $vals[0] ?? '',
        'effet' => $vals[1] ?? '',
        'decor' => $vals[2] ?? '',
        'info' => $vals[3] ?? '',
    ];
}, file($file));
array_shift($scenes); // remove column header



foreach ($scenes as $scene) {
    $sceneFolder = sceneExist($scene['number']);
    if (!empty($sceneFolder)) {
        extract($scene);
        $effet = strtoupper($effet);
        $yml = "effet: $effet\ndecor: $decor\ninfo: $info\n";
        file_put_contents("$sceneFolder/data.yml", $yml);

        fwrite(STDOUT, "Data writen to $sceneFolder\n");
    }
}

?>

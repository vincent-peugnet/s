<?php
    $srcDir = $argv[1];
    $dirs =  array_diff(scandir($srcDir), array('..', '.')); 
    $scenes =  array_filter($dirs, function($dirname) use($srcDir): bool {
        return is_dir($srcDir . DIRECTORY_SEPARATOR . $dirname);
    });
?>

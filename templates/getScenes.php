<?php
    $dir = $argv[1];
    $dirs =  array_diff(scandir($dir), array('..', '.')); 
    $scenes =  array_filter($dirs, function($dirname) use($dir): bool {
        return is_dir($dir . DIRECTORY_SEPARATOR . $dirname);
    });
?>

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
?>

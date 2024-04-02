<?php

/**
 * Add links to scenes and shots
 */
function autoLink(string $infoText, string $currentScene, string $prefix): string
{
    $infoText = str_replace('./', "$currentScene/", $infoText);
    return preg_replace_callback('#(\w+)?/(\w+)?#', function($matches) use($prefix) {
        $scene = $matches[1] ?? null;
        $shot = $matches[2] ?? null;

        global $scenes;
        if (!in_array($scene, $scenes)) {
            return $matches[0];
        }

        $linkText = '';
        $href = "$prefix/$scene/index.html";
        $linkText = $scene;
        if (!empty($shot)) {
            $href .= "#$shot";
            $linkText .= "/$shot";
        }
        return "<a href=\"$href\" class=\"sLink\">$linkText</a>";
    }, $infoText);
}

?>

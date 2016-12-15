<?php
function replaceMain($template){
        $template = str_replace("<!--%title%-->", $GLOBALS["title"], $template);
        $template = str_replace("<!--%keywords%-->", $GLOBALS["keywords"], $template);
        $template = str_replace("<!--%description%-->", $GLOBALS["description"], $template);
        return $template;
    }
?>
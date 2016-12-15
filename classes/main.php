<?php
class data {
    public function formPage($base, $template) {
        $template = str_replace('<li><a href="index.php">',
                '<li id="selected"><a href="index.php">', $template);
        $template = str_replace("<!--%content%-->", "Це наповнення сторінки"
                . " без виводу новини.<br /><br /><br /><br /><br />"
                . "<br /><br /><br /><br /><br /><br />", $template);
        return $template;
    }
    
}
?>

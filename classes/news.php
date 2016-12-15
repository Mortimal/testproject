<?php
class data {
    public function formPage($base, $template) {
        
        
        
        $content = '';
        
        $template = str_replace("<!--%content%-->", $content, $template);
        return $template;
    }
    
}


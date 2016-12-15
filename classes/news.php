<?php
class data {
    public function formPage($base, $template) {
        
        if (!isset($_GET["id"])){
            $content = 'Тут можливий бложний вивід новин.'
                    . '<br /><br /><br /><br /><br /><br /><br /><br />'
                    . '<br /><br /><br /><br /><br /><br /><br /><br />';
        }else{
            $res = $base->selecttoarr("SELECT * FROM news WHERE `id` = ".
                    $_GET["id"]." LIMIT 1");
            if ($res[0]['id'] != ""){
                $usr = $base->selecttoarr("SELECT login FROM users WHERE `id`"
                        . "=".$res[0]['creatorid']."");
                $content = '<h1>'.$res[0]['name'].'</h1>'
                        . '<p>'.$res[0]['content'].'</p>'
                        . '<p align="right" class="post-footer">'
                        . '<a href="index.php?user='.$res[0]['creatorid'].'" class="readmore">'.$usr[0]['login'].'</a>'
                        . $res[0]['date'].'</p>';
                $content .= $this->commentsWorker($res[0]['id']);
            }else{
                header('Refresh: 2; URL=index.php?page=news&id=1');
                $content = '<h2>Новини з таким номером не існує.</h2>';
            }
        }
        
        $template = str_replace("<!--%content%-->", $content, $template);
        return $template;
    }
    public function commentsWorker($id) {
        
        return 0;
    }
}


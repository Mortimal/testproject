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
                $content .= $this->commentsWorker($res[0]['id'],$base);
            }else{
                header('Refresh: 2; URL=index.php?page=news&id=1');
                $content = '<h2>Новини з таким номером не існує.</h2>';
            }
        }
        
        $template = str_replace("<!--%content%-->", $content, $template);
        return $template;
    }
    private function commentsWorker($id, $base) {
        $res = $base->selecttoarr("SELECT id, referedtoid FROM comments WHERE `newsid` = $id");
        $return = array();
        foreach ($res as $value) {
            $return[$value['referedtoid']][] = $value;
        }
                        $this->category_arr = $return;
        $content = $this->outTree(0, 0,$base);

        return $content;
    }
    private $category_arr;
    private $retn;
    
    private function outTree($parent_id, $level,$base) {
        if (isset($this->category_arr[$parent_id])) {
            foreach ($this->category_arr[$parent_id] as $value) {
                echo $value['id'];
                $this->retn .= $this->commentFormer($value['id'],$base,$level);
                
                $level++;
                $this->outTree($value['id'], $level,$base);
                $level--;
            }
        }
        return $this->retn;
    }
    private function commentFormer($id,$base,$level){
        $res = $base->selecttoarr("SELECT c.id, c.creatorid, c.text, u.login"
                . "                FROM comments AS c"
                . "                INNER JOIN users AS u ON  c.creatorid = u.id"
                . "                WHERE c.id = $id");
        
        $comment .= '<div style=margin-left:' . ($level * 25) . 'px;>'
                . '<h3><a href="index.php?user='.$res[0]['id'].'">'.$res[0]['login'].'</a></h3>'
                . '<p>' .$res[0]['text']  . '<p>'
                . '<a href="index.php?user='.$res[0]['id'].'">відповісти</a></div>';
        return $comment;
    }
}


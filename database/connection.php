<?php
require 'config.php';
        
class databasecon {
    
    
    private $link;
    private $qresult;
    
    public function connect(){
        $this->link = mysql_connect($GLOBALS["hostname"],
                                    $GLOBALS["login"],
                                    $GLOBALS["pass"]);
        if (!$this->link) {
            die('Помилка під\'єднання до хосту: ' . mysql_error());
        }
                
        if (!mysql_select_db($GLOBALS["database"])) {
            die('Помилка під\'єднання до бази даних: ' . mysql_error());
        //}else{
        //  echo 'OK';
        }
        
    }
    
    public function disconnect(){
        mysql_close($this->link);
    }
    
    public function insert($query) {
        if (!mysql_query($query)){
            die ('Неможливо "змінити" базу даних.'. mysql_error());
        }
    }
    
    public function selecttoarr($query) {
        $this->qresult = mysql_query($query);
        
        if (!$this->qresult) {
            die ('Не можливо отримати запит ('
                    .$query.
                    ') з бази даних: '
                    .mysql_error());
        }
        
        for ($i = 0;$i < mysql_num_rows($this->qresult);$i++){
            $arr[$i] = mysql_fetch_assoc($this->qresult);
        }
        
        return $arr;
    }
}
?>
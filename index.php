<?php
ob_start();

require_once 'main_chars.php';
require_once 'functions/main.php';
require_once 'database/connection.php';

$base = new databasecon();
$base->connect();
$base->insert("SET NAMES utf8");

$template = 
        file_get_contents($_SERVER['DOCUMENT_ROOT']
                .'/templates/main/index.html');
$template = replaceMain($template);

$logindata = "";

if ($_POST["submit"]){
    ob_end_clean();
    require_once 'functions/login.php';
}elseif($_POST["exit"]){
    require_once 'functions/exit.php';
    require_once 'functions/cleanEnter.php';
}else{
    if ($_COOKIE["logindata"]){
        require_once 'functions/loginedEnter.php';
    }else{
        require_once 'functions/cleanEnter.php';
    }
}

if ($logindata==""){
    if (empty($_GET["page"])){
        require_once 'classes/main.php';
    }elseif ($_GET["page"] == "kontakty"){
        
    }
    
    $data = new data();
    echo $data->formPage($base, $template);
}else{
    $template = str_replace('<!--%content%-->',
                $logindata, $template);
    echo $template;
}


$base->disconnect();



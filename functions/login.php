<?php
$res = $base->selecttoarr("SELECT login, password FROM users WHERE login = '".$_POST["login"]."' LIMIT 1");
if ($res[0]['login']!=""){
    
    if (md5($_POST["password"]) == $res[0]['password']){
        setcookie("logindata",md5($res[0]['login'].''.
                                  $res[0]['password']),time()+10000);

    $template = str_replace("<!--%login%-->",
            '<form class="search" method="post" action="index.php">
				<p><strong>'.$res[0]['login'].'</strong>
	 			&nbsp;&nbsp;&nbsp;
                                <input class="button" type="submit" name="exit" value="Вийти" />
				</p>
            </form>'
            , $template);

    $template = str_replace("<!--%mainmenu%-->",
'               <ul>
                  <li><a href="index.php">Домашня</a></li>
   	 	</ul>'
            ,$template);
    header('Refresh: 2; URL=index.php');
$logindata = '
<h2>
    Ви увійшли як, '.$res[0]['login'].'.
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
</h2>';
    }else{
        header('Refresh: 2; URL=index.php');
        $logindata = '
        <h2>
        Пароль не вірний.
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
</h2>';
    }
    
    
}else{
    header('Refresh: 2; URL=index.php');
    $logindata = '
    <h2>
    Такого користувача не існує.
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
</h2>';
}        
?>
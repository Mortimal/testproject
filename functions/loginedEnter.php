<?php
    $res = $base->selecttoarr("SELECT login FROM users WHERE MD5(CONCAT(login,password))= '".$_COOKIE["logindata"]."'");

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
                  <li><a href="index.php?page=news&id=1">Домашня</a></li>
   	 	</ul>'
            ,$template);
?>
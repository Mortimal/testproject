<?php
$template = str_replace("<!--%login%-->",
            '<form class="search" method="post" action="index.php">
				<p>
	  			Логін: <input class="textbox" type="text" name="login" value="" />
                                Пароль: <input class="textbox" type="password" name="password" value="" />
	 			<input class="button" type="submit" name="submit" value="Увійти" />
				</p>
            </form>'
            , $template);
$template = str_replace("<!--%mainmenu%-->",
'               <ul>
                  <li><a href="index.php">Домашня</a></li>
   		</ul>'
            ,$template);
?>
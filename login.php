<?php

	if (isset($_GET['login'])) 
    { 
    	$login = trim(stripslashes(htmlspecialchars($_GET['login'])));
    	if ($login =='') 
    	{ 
    		unset($login);
    	} 
    }
    if (isset($_GET['password'])) 
    { 
    	$password = trim(stripslashes(htmlspecialchars($_GET['password'])));
    	$password2 = trim(stripslashes(htmlspecialchars($_GET['con_password'])));
    	if ($password =='') 
    	{
    		unset($password);
    	}
    }
	//echo '<p align="center">';
 	if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
    	exit ( 'Вы ввели не всю информацию, заполните все поля!  <br><a href="index.html">Вернуться на главную</a></p>');
    }
    else 
    {
        include ("vars.php");
        //извлекаем из базы все данные о пользователе с введенным логином
        $result = mysqli_query($sqlc,"SELECT * FROM pupil WHERE login='$login'"); 
        $myrow = mysqli_fetch_array($result);
	    //если существует, то сверяем пароли
	    if ($myrow['password']==$password) 
	    {
		    //если пароли совпадают, то запускаем пользователю сессию! Можете его поздравить, он вошел!
            setcookie("login",$myrow['login']); 
            setcookie("id",$myrow['id']); 
		    //echo 'Вы успешно вошли на сайт! <a href="index.html">Главная страница</a>';
            header("Location: http://$host$uri/$extra");
            exit;
    	}
 		else 
 		{
		    //если пароли не сошлись
			exit (' введённый вами login или пароль неверный. <a href="index.html">Главная страница</a>');
    	}
    }
	
    //echo "<br>Вы вошли на сайт, как ".$_SESSION['login']."<br><a  href='http://vk.com/'>Вконтакт</a>";
?>
<!DOCTYPE HTML>
<HTML>
	<HEAD>
		<TITLE>Web-интерфейс</TITLE>

        <table align="center" cellpadding="5" >
          <tr>
            <td align="right" width="20%">  
                <a href="index.html"><img src="img/logo.png" alt="Logo" width="100%" align="left" ></a>
            </td>
            <td align="center"> 
                <h1>Регистрация</h1>
            </td>
          </tr>
        </table>
	</HEAD>
	<body >
		<?php echo
		'<form method="GET" action="' . $_SERVER['PHP_SELF'] . '">' . "\n";?>
			<style>
				p{ 
					text-align: right;
					margin-right: 20vw;
				 }
			</style>
			<?php echo '<p>Логин <input name="login" size="15" maxlength="15" autocomplete="off" value="'.$_GET["login"].'"></p>
                        <p>Пароль <input name="password" size="15" maxlength="15" autocomplete="off" value="'.$_GET["password"].'"></p> 
                        <p>Повторите пароль <input name="con_password" size="15" autocomplete="off" maxlength="15" value="'.$_GET["con_password"].'"></p>' ;?>
			<h3 align="center"><input type="submit" style="height: 5vmax; width: calc(1.2vmax*20); text-align:center; font-size: 2vmax;" value="Зарегистрироваться" ></h3>
		</form>
	</body>

 <?php 
    if (isset($_GET['login']) or isset($_GET['password']))
 	{
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
    
        echo '<p align="center">';
         if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
        {
            exit ( 'Вы ввели не всю информацию, заполните все поля! </p>');
        }
         if (strCmp ( $password , $password2 ) != 0) //если подтверждение не совпадает
        {
            exit ('Пароли не совпадают </p>');
        }
    
         // подключаемся к базе
        // файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 
        include ("db.php");
    
         // проверка на существование пользователя с таким же логином
        $result = mysqli_query($sqlc,"SELECT id FROM pupil WHERE login='$login'");
        $myrow = mysqli_fetch_array($result);
        if (!empty($myrow['id'])) 
        {
            exit ('Извините, введённый вами логин уже зарегистрирован. Введите другой логин.</p>');
        }
        // если такого нет, то сохраняем данные
        $result2 = mysqli_query ($sqlc,"INSERT INTO pupil (login,password) VALUES('$login','$password')");
        // Проверяем, есть ли ошибки
        if ($result2=='TRUE')
        {
            echo "Вы успешно зарегистрированы! Теперь вы можете зайти на сайт. </br> <a href='index.php'>Главная страница</a>";
        }
        else 
        {
            echo "Ошибка! Вы не зарегистрированы.";
        }
    
        echo '</p>';
    }
 ?>
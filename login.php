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
 	if (empty($login) or empty($password)) //���� ������������ �� ���� ����� ��� ������, �� ������ ������ � ������������� ������
    {
    	exit ( '�� ����� �� ��� ����������, ��������� ��� ����!  <br><a href="index.html">��������� �� �������</a></p>');
    }
    else 
    {
        include ("vars.php");
        //��������� �� ���� ��� ������ � ������������ � ��������� �������
        $result = mysqli_query($sqlc,"SELECT * FROM pupil WHERE login='$login'"); 
        $myrow = mysqli_fetch_array($result);
	    //���� ����������, �� ������� ������
	    if ($myrow['password']==$password) 
	    {
		    //���� ������ ���������, �� ��������� ������������ ������! ������ ��� ����������, �� �����!
            setcookie("login",$myrow['login']); 
            setcookie("id",$myrow['id']); 
		    //echo '�� ������� ����� �� ����! <a href="index.html">������� ��������</a>';
            header("Location: http://$host$uri/$extra");
            exit;
    	}
 		else 
 		{
		    //���� ������ �� �������
			exit (' �������� ���� login ��� ������ ��������. <a href="index.html">������� ��������</a>');
    	}
    }
	
    //echo "<br>�� ����� �� ����, ��� ".$_SESSION['login']."<br><a  href='http://vk.com/'>��������</a>";
?>
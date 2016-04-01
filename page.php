<!DOCTYPE HTML>
<HTML>
    <HEAD>
    <TITLE>Web-Интерфейс</TITLE>
    <style>
	   h1 {
	   	text-align: center;
	   	margin-right: 5vw;
	    margin-bottom: 5vh; /* ??? ???*/
	    font-size: 6vmax;
	   }
	</style>
	<?php 
		echo '<h1><a href="index.html"><img src="img/logo.png" alt="logo" width="20%" align="left"></a>';
		if ($_COOKIE['login'])
		{
			include ("vars.php");
	    	echo 'Hello, '.$_COOKIE['login'].'</h1>';

	        echo 'Сейчас:';
			if($rows=qer("now"))
			{
				echo '<form method="GET" action="db.php">
				  		<table align="center" cellpadding="5" >
					  	<tr>
					    	<td align="right" width="60%">';
							foreach($rows as $row)
							{
								echo '<p><input name="olymps" type="radio" value="'.$row['OlympsID'].'">'.$row['Name'].' до '.$row['Endtime'].'</p>';
							}
					   echo '<td width="40%">
					    		<input type="image" src="img/start.png" height="100vh">  </td>
					  	</tr>
						</table>
		  			</form>';
			}
			else{echo "Nothing";}

	        echo 'Скоро:';
			if($rows=qer("will"))
			{
				foreach($rows as $row)
				{
	        		echo '<p>'.$row['Name'].' с '.$row['Starttime'].' до '.$row['Endtime'].'</p>';
				}
			}
			else{echo "Nothing";}
		}
		else{echo 'Something wrong';}
	?>
    </HEAD>
<BODY>

</BODY>
</HTML>



<?php
	function qer($arg)
	{
		$query="SELECT * FROM olymps WHERE starttime > endtime";
		include ("vars.php");
		switch ($arg) {
	    case "will":
	        $query="SELECT * FROM olymps WHERE starttime > now()";
	        break;
	    case "was":
	        $query="SELECT * FROM olymps WHERE endtime < now()";
	        break;
	    case "now":
	    	$query="SELECT * FROM olymps WHERE starttime < now() and endtime > now()"; 
	        break;
		}
	    $result = mysqli_query($sqlc, $query);

		while($row = mysqli_fetch_array($result))
		{
			$myrows[] = $row;
		}
		/* free result set */
		$result->close();

		return $myrows;
	}
?>
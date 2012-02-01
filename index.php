<?php

if(isset($_POST['opt']))
{
	if ($_POST['opt'] == 1)
	{
		$query = "SELECT cardno, value FROM card2 ORDER BY RAND() LIMIT 10";

		$hostname = '';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'cards';

		$conn = mysql_connect($hostname, $dbuser, $dbpass);
		if (!$conn)
		{
		        die("Couldn't connect to DB: ".mysql_error());
		}

		mysql_select_db($dbname, $conn);

		function query($q)
		{
		        global $conn;
		        $result = mysql_query($q, $conn);
		        if (!$result)
		        {
		                die("Invalid query -- $q --" . mysql_error());
		        }
		        return $result;
		}

		function format($result)
		{
		        $rsarray = array();
		        while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
		        {
		                $rsarray[]=$row;
		        }
		        return $rsarray;
		}

		$result = format(query($query));
		$n = count($result);
		$z = range(0,4);
		shuffle($z);

		mysql_query("UPDATE computer SET misc=1 where sno=1;");

		for($i=0; $i<$n; $i++)
		{
			$cardno = $result[$i]['cardno'];
			$value = $result[$i]['value'];
		
			if($i<5)
			{
				$play = $z[$i];
				mysql_query("UPDATE computer SET cardno='$cardno', value='$value', state=0, play=$play, misc=0 where sno = $i+1;");	
			}
			else
			{
				mysql_query("UPDATE player SET cardno='$cardno', value='$value', state=0, misc=0 where sno = $i-4;");
			}
		}
		header ("Location: start.php");
	
	}		
	
	else
	{
		header ("Location: start.php");
	}
}		

?>


<html>
<head>
<title>Card War</title>
</head>

<body>
<h2>Welcome to CARD WAR</h2><hr>

<form action="" method="post" name="game1">
	<input type="radio" name="opt" value=1 />
	<input type="submit" name="new1" value="New Game"/>
</form>

<form action="" method="post" name="game1">
	<input type="radio" name="opt" value=2 />
	<input type="submit" name="new2" value="Continue Game"/>
</form>

</body>
</html>



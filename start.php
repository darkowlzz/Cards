<?php

//var_dump($_POST);

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

$query = "SELECT cardno, value, sno, state FROM computer;";
$result1 = format(query($query));
$query = "SELECT cardno, value, sno, state FROM player;";
$result2 = format(query($query));

$n = count($result1);
$m = count($result2);

$card1 = array();
$value1 = array();
$sno1 = array();
$state1 = array();


for ($i=0; $i<$n; $i++)
{
	$card1[$i] = $result1[$i]['cardno'];
	$value1[$i] = $result1[$i]['value'];
	$sno1[$i] = $result1[$i]['sno'];
	$state1[$i] = $result1[$i]['state'];
}


$card2 = array();
$value2 = array();
$sno2 = array();
$state2 = array();

for ($i=0; $i<$m; $i++)
{
	$card2[$i] = $result2[$i]['cardno'];
	$value2[$i] = $result2[$i]['value'];
	$sno2[$i] = $result2[$i]['sno'];
	$state2[$i] = $result2[$i]['state'];
}


function render($x,  $y)
{
	echo "<hr><br/>";
	echo "<p>Computer: $x<br/>
	     Player: $y</p>";
	global $state2;
	if($state2[0]==1 && $state2[1]==1 && $state2[2]==1 && $state2[3]==1 && $state2[4]==1)
	{
		if($x > $y)
			echo "<h3>You loose</h3>";
		else if($x < $y)
			echo "<h3>You win</h3>";
		else
			echo "<h3>Game Draw</h3>";

		echo "<p>Click on home and start a new game</p>";
	}
}

function realval($x)
{
	if($x > 38)
		return $x-39;
	else if($x > 25)
		return $x-26;
	else if($x > 12)
		return $x-13;
	return $x;
}
	


	if(isset($_POST['card']))
	{
		$a = $_POST['card'];
		mysql_query("UPDATE player SET state=1 WHERE sno=$a");
		$state2[$a-1]=1;
		$r1 = mysql_query("SELECT value FROM player WHERE sno=$a");
		$r1 = mysql_fetch_row($r1);
		$y = $r1[0];
		$y = realval($y);
		mysql_query("UPDATE computer SET state=1 WHERE sno=$a");
		$state1[$a-1]=1;
		$r2 = mysql_query("SELECT value FROM computer WHERE sno=$a");
		$r2 = mysql_fetch_row($r2);
		$x = $r2[0];
		$x = realval($x);
		
		if($x > $y)
			mysql_query("UPDATE computer SET misc=misc+1 where sno=1");
		else if ($x < $y)
			mysql_query("UPDATE player SET misc=misc+1 where sno=1");
		else
		{
			mysql_query("UPDATE computer SET misc=misc+1 where sno=1");
			mysql_query("UPDATE player SET misc=misc+1 where sno=1");
		}

		$x = mysql_query("SELECT misc FROM computer WHERE sno=1");
		$x = mysql_fetch_row($x);
		$v = $x[0];
		$y = mysql_query("SELECT misc FROM player WHERE sno=1");
		$y = mysql_fetch_row($y);
		$w = $y[0];
		
		render($v, $w);
//		echo $r2[0];		
//		header ("Location: start.php");	
	
	}

?>

<html>
<head>
<title>Card Game</title>

<style type="text/css">
#container {width:500px; border:0px solid}
#box1 {width:75px; float:left; border:0px solid; margin:10px}
#box2 {width:75px; float:left; border:0px solid}
</style>

</head>


<body>
<hr>
<h2>CARD WAR</h2>
<p>Beta</p><hr>
<a href="index.php">Home</a>
<div id="container">

<div id="box1">
<?php
	if($state1[0] == 0)
	{
		echo '<label><img src="images/cover.png"/></label>';
	}
	else
	{
		echo "<label><img src='$card1[0]'/></label>";
	}
?>
</div>	

<div id="box1">
<?php
	if($state1[1] == 0)
	{
		echo '<label><img src="images/cover.png"/></label>';
	}
	else
	{
		echo "<label><img src='$card1[1]'/></label>";
	}
?>
</div>

<div id="box1">
<?php
	if($state1[2] == 0)
	{
		echo '<label><img src="images/cover.png"/></label>';
	}
	else
	{
		echo "<label><img src='$card1[2]'/></label>";
	}
?>
</div>

<div id="box1">
<?php
	if($state1[3] == 0)
	{
		echo '<label><img src="images/cover.png"/></label>';
	}
	else
	{
		echo "<label><img src='$card1[3]'/></label>";
	}
?>
</div>

<div id="box1">
<?php
	if($state1[4] == 0)
	{	
		echo '<label><img src="images/cover.png"/></label>';
	}
	else
	{
		echo "<label><img src='$card1[4]'/></label>";
	}
?>
</div>

</div>


<div id="container">

<div id="box1">
<form action="" method="post" name="card1">
<?php
	if($state2[0] == 0)
	{
		echo '<label><img src="images/cover.png"/></label>';
	}
	else
	{
		echo "<label><img src='$card2[0]'/></label>";
	}
?>
		<input type="radio" name="card" value=1 />
		<input type="submit" value="play" <?php if($state2[0]!=0) echo "disabled='disabled'";?>/>
</form>
</div>

<div id="box1">
<form method="post" name="card2">
<?php
	if($state2[1] == 0)
	{
		echo '<label><img src="images/cover.png"/></label>';
	}
	else
	{
		echo "<label><img src='$card2[1]'/></label>";
	}
?>
		<input type="radio" name="card" value=2 />
		<input type="submit" value="play" <?php if($state2[1]!=0) echo "disabled='disabled'";?>/>
</form>
</div>

<div id="box1">
<form method="post" name="card3">
<?php
	if($state2[2] == 0)
	{
		echo '<label><img src="images/cover.png"/></label>';
	}
	else
	{
		echo "<label><img src='$card2[2]'/></label>";
	}
?>
		<input type="radio" name="card" value=3 />
		<input type="submit" value="play" <?php if($state2[2]!=0) echo "disabled='disabled'";?>/>
</form>
</div>

<div id="box1">
<form method="post" name="card4">
<?php
	if($state2[3] == 0)
	{
		echo '<label><img src="images/cover.png"/></label>';
	}
	else
	{
		echo "<label><img src='$card2[3]'/></label>";
	}
?>
		<input type="radio" name="card" value=4 />
		<input type="submit" value="play" <?php if($state2[3]!=0) echo "disabled='disabled'";?>/>
</form>
</div>

<div id="box1">
<form method="post" name="card5">
<?php
	if($state2[4] == 0)
	{	
		echo '<label><img src="images/cover.png"/></label>';
	}
	else
	{
		echo "<label><img src='$card2[4]'/></label>";
	}
?>
		<input type="radio" name="card" value=5 />
		<input type="submit" value="play" <?php if($state2[4]!=0) echo "disabled='disabled'";?>/>
</form>
</div>

</div>



</body>
</html>


<?php


?>

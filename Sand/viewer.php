<?php
// Hämtar din info eller starta ny session
session_start(); 
error_reporting(0);

// Databasanslutningen
include "conn.php"; 

// Tittar ifall $_GET['id']  är en siffra annars exit
if(isset($_GET['id']) && !is_numeric($_GET['id'])){
	echo 'Något blev fel, tillbaka till <a href="index.php">Index</a><br>';
	exit();
	
	}

// Pagingvariablar
$sida = $_GET['sida']; 
$forr = ($sida - 1);
$nest = ($sida + 1);
$lim = ($sida * $antal_kom);
$slut = ($antal_kom + 1);

// Tar bort kommentaren ur databasen
if (isset($_GET['radera']) && isset($_SESSION['sess_user'])){
		$sql="DELETE FROM kom WHERE id={$_GET['radera']}";
		mysql_query($sql);
		header("Location: viewer.php?id=".$_GET['id']."&sida=0");
}

//Tar bort nyheten ur databasen 
if (isset($_GET['raderany']) && isset($_SESSION['sess_user'])){
		$sql="DELETE FROM news WHERE id={$_GET['raderany']}";
		mysql_query($sql);
			//Tar även bort nyhetesn kommentarer
			$sql="DELETE FROM kom WHERE ny_id={$_GET['raderany']}";
			mysql_query($sql);
		
		header("Location: index.php");
		exit();
}

//Bannlys användare
if (isset($_GET['bannlys']) && isset($_SESSION['sess_user'])){
	$sql="INSERT INTO bans SET ip='{$_GET["bannlys"]}', datum='{$datum}'";
	mysql_query($sql);
}


// Sätter in kommentaren i databasen
if (isset($_POST['submit']) && !empty($_POST['namn']) && !empty($_POST['text']) && !empty($_POST['security_code']) && $_SESSION['security_code'] == $_POST['security_code']){
		$sql = "INSERT INTO kom SET ny_id='{$_GET['id']}', text='{$_POST['text']}', namn='{$_POST['namn']}', datum='{$datum}',ip='{$_SERVER['REMOTE_ADDR']}'";
		mysql_query($sql);
		}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?php echo $title;?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<script language="javascript" type="text/javascript" src="niceforms.js"></script>
	<meta name="keywords" content="php, free script, news, portal, cms" />
	<meta name="author" content="Erik Magnusson" />
	<style type="text/css" media="all">@import "style.css";</style>
</head>

<body>
<div id="content">
<div id="toph"></div>
	
	<div id="center">
<?php

// Hämtar nyheten från databasen
$sql = "SELECT * FROM news WHERE id='{$_GET['id']}'";
$result = mysql_query($sql);
// Skriver ut nyheten
	while($rad=mysql_fetch_array($result)){
		echo 	'<div id="news">
				<div id="title">'.$rad['title'].'</div>
				<div id="datum">'.$rad['datum'].'</div>
				<div id="forfattar">'.$rad['forfattare'].'</div>
				<div id="text">'.$rad['text'].'</div>';
					if (isset($_SESSION['sess_user'])){
						echo '<a href="viewer.php?raderany='.$rad['id'].'"><img src="images/radera.png" align="right" alt="Radera kommentaren" border="0" /></a>';
						echo '<a href="admin.php?edit_ny&id='.$rad['id'].'"><img src="images/edit.png" align="right" alt="Radera kommentaren" border="0" /></a><br> ';
				}
				 echo '</div>';
	}
	
// Tittar ifall det finns någon nyhet med id=$_GET['id']
if(mysql_num_rows($result) == 0){	
		echo 	'<div id="news">Det finns ingen nyhet med det ID-nr.</div>';
		exit();
}
// Hämtar kommentarerna från databasen
$sql = "SELECT * FROM kom WHERE ny_id='{$_GET['id']}' ORDER BY datum DESC LIMIT $lim, $slut ";
$result = mysql_query($sql);   
for ($i = 0; $i < $antal_kom && $rad=mysql_fetch_array($result); $i++) { 
		echo '<div id="news">
				<div id="forfattarkom"><h2>'.nl2br(htmlentities($rad['namn'])).'</h2></div>
				<div id="datumkom">'.nl2br(htmlentities($rad['datum'])).'</div>
				<div id="kom">'.nl2br(htmlentities($rad['text'])).'</div>';
					if (isset($_SESSION['sess_user'])){
						echo '<a href="viewer.php?id='.$_GET['id'].'&radera='.$rad['id'].'"><img src="images/radera.png" align="right" alt="Radera kommentaren" border="0" /></a> ';
						echo '<a href="viewer.php?id='.$_GET['id'].'&bannlys='.$rad['ip'].'"><img src="images/ban.png" align="right" alt="Bannlys användaren" border="0" /></a>'.$rad['ip'];
				}
				echo '</div>';
	}
	
if(mysql_num_rows($result) > $antal_kom){
	echo '<a class="rightalign" href="viewer.php?id='.$_GET['id'].'&sida='.$nest.'">Nästa sida</a>';
}

if(!$sida == 0){
	echo '<a class="leftalign" href="viewer.php?id='.$_GET['id'].'&sida='.$forr.'">Föregående sida</a><br>';
}

if(mysql_num_rows($result)==0){	
	echo 	'<div id="news">Det finns inga kommentarer än.</div>';
}

if (isset($_POST['submit'])){
	if (empty($_POST['namn']) || empty($_POST['text']) || empty($_POST['security_code'])){
		echo 	'<div id="error">Du har glömt att fylla in något fält</div>';
	}
	elseif ($_SESSION['security_code'] != $_POST['security_code']){
		echo 	'<div id="error">Du har svarat fel på spammfrågan, är du en bot?</div>';
	}
	else{
		echo 	'<div id="ok">Du har nu kommenterat nyheten.</div>';
	}
}

// Tittar ifall ip-adressen finns med i databasen
$sql = "SELECT ip FROM bans WHERE ip ='{$_SERVER['REMOTE_ADDR']}'";
$result = mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($result) > 0) {
		echo 	'<div id="news">Du kan inte posta kommentarer eftersom du är bannlyst</div>';
}
else 
{
?>
<h1>Kommentera</h1>
<form action="viewer.php?id=<?php echo $_GET['id']; ?>&sida=0" method="post" >
<label for="namn">Namn:</label><br>
<input type="text" name="namn" size="86" value="<?php echo $_POST['namn'];?>">
<label for="text">Kommentar:</label><br>
<textarea id="textarea" name="text" cols="65" rows="10"><?php echo $_POST['text'];?></textarea><br><br>
<img src="captcha.php" /><br>
<label for="security_code">Skriv in texten ovan här:</label><br>
<input type="text" id="security_code" name="security_code" size="86"/><br>
<label for="security_code">Klicka på Kommentera för att få en ny bild. Informationen du har fyllt i kommer inte att försvinna.</label><br>
<div id='news'>Ditt ip kommer att loggas när du lägger en kommentar: <?php echo $_SERVER['REMOTE_ADDR']?></div><br>
<input type="submit" name="submit" value="Kommentera">
</form>
<?php
}
?>
<a href="index.php">Index</a>
</div>
<div id="footer"></div>
</div>	
</body>
</html>

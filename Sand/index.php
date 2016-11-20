<?php
session_start(); 
error_reporting(0);

// Databasanslutningen samt hämtar inställninganra
include "conn.php"; 

// Tittar ifall $_GET['sida'] är satt och är en siffra
if(isset($_GET['sida']) && !is_numeric($_GET['sida'])){
	exit("Hackningsförsök");
}

// Pagingvariablar
$sida = $_GET['sida']; 
$forr = ($sida - 1);
$nest = ($sida + 1);
$lim = ($sida * $antal_ny);
$slut = ($antal_ny + 1);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?php echo $title;?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="keywords" content="php, free script, news, portal, cms" />
	<meta name="author" content="Erik Magnusson" />
	<style type="text/css" media="all">@import "style.css";</style>
</head>

<body>
<div id="content">
	<div id="toph"></div>
		<div id="center">
<?php
// Hämtar ut nyheterna ur databasen
$sql = "SELECT * FROM news ORDER BY datum DESC LIMIT $lim, $slut ";
$result = mysql_query($sql);   
	for ($i = 0; $i < $antal_ny && $rad=mysql_fetch_array($result); $i++) {
		// Räknar kommentarerna för den nyheten
		$sqlkom = "SELECT * FROM kom WHERE ny_id= '{$rad['id']}'";
		$resultkom = mysql_query($sqlkom);   
			echo   '<div id="news">
					<div id="title">'.$rad['title'].'</div>'.'
					<div id="datum">'.$rad['datum'].'</div>
					<div id="forfattar">'.$rad['forfattare'].'</div>
					<div id="text">'.$rad['text'].'</div>
					<br><a href="viewer.php?id='.$rad['id'].'&sida=0">('.mysql_num_rows($resultkom).')Kommentarer</a><br>';
						if (isset($_SESSION['sess_user'])){
							echo '<a href="viewer.php?raderany='.$rad['id'].'"><img src="images/radera.png" align="right" alt="Radera kommentaren" border="0" /></a>';
							echo '<a href="admin.php?edit_ny&id='.$rad['id'].'"><img src="images/edit.png" align="right" alt="Radera kommentaren" border="0" /></a><br>';
						}
					echo "</div>";
} 		
 
if(mysql_num_rows($result) > $antal_ny){
	echo '<a class="rightalign" href="index.php?sida='.$nest.'">Nästa sida</a>';
}

if(!$sida == 0){
	echo '<a class="leftalign" href="index.php?sida='.$forr.'">Föregående sida</a> ';
}

if(mysql_num_rows($result)==0){	
	echo 	'<div id="news">Det finns inga nyheter ännu. Logga in som admin för att lägga till nyheter.</div>';
}
?>

</div>	
<div id="footer"></div>
</div>	
<a class="admin" href="admin.php?settings">Admin</a>
</body>
</html>

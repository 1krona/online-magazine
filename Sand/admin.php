<?php 
#############################################
#											
#	Exnews 1.0								
#	Skapat av Erik Magnusson				
#	Med hjälp av open source WYSIWYG 		
#	www.Exittor.com							
#	Detta script får användas fritt 		
#	sålänge du inte tar bort denna text		
#											
#############################################
// Hämtar din info eller starta ny session
session_start();
error_reporting(0);
 
// Databasanslutningen
include "conn.php"; 

// Hämtar användarnamn och namn
$sql = "SELECT * FROM members WHERE id='{$_SESSION['sess_id']}'";
$result = mysql_query($sql);
$rad=mysql_fetch_array($result);
$_SESSION['sess_namn'] = $rad['namn'];


// Inloggning
if (isset($_POST['submit'])){
  $_POST = db_escape($_POST);
  $sql = "SELECT id FROM members WHERE user='{$_POST['user']}' AND pass='{$_POST['passwd']}'";
  $result = mysql_query($sql);
  
  // Hittades inte användarnamn och lösenord
  // skicka till formulär med felmeddelande
  if (mysql_num_rows($result) == 0){
    header("Location: admin.php?badlogin=");
    exit;
  }
  
  // Sätt sessionen med unikt index
  $_SESSION['sess_id'] = mysql_result($result, 0, 'id');
  $_SESSION['sess_user'] = $_POST['user'];
  header("Location: admin.php?settings");
  exit; 
}
 
// Utloggning
if (isset($_GET['logout'])){
  session_unset();
  session_destroy();
  header("Location: index.php");
  exit;
}

//Tar bort nyheten ur databasen
if (isset($_GET['raderany']) && isset($_SESSION['sess_user'])){
	$sql="DELETE FROM news WHERE id={$_GET['raderany']}";
	mysql_query($sql);
}

//Ta bort bannlysningar
if (isset($_GET['raderaban']) && isset($_SESSION['sess_user'])){
	$sql = "DELETE FROM bans WHERE ip='{$_GET["raderaban"]}'";
	mysql_query($sql);
	header("Location: admin.php?bans");
	exit();
}

//Ta bort användare
if (isset($_GET['raderauser']) && isset($_SESSION['sess_user'])){
	$sql = "DELETE FROM members WHERE id='{$_GET["raderauser"]}'";
	mysql_query($sql);
	header("Location: admin.php?users");
	exit();
}

// Uppdaterar inställningarna 
if(isset($_POST['submitsetting'])){
	if(!empty($_POST['antal_ny']) && !empty($_POST['antal_kom']) && !empty($_POST['title'])){
	$sql = "UPDATE settings SET antal_ny='{$_POST['antal_ny']}', antal_kom='{$_POST['antal_kom']}', title='{$_POST['title']}'";
	mysql_query($sql);
	}
	if(!empty($_POST['ny_pass'])){
	$sql = "UPDATE members SET pass='{$_POST['ny_pass']}' WHERE id='{$_SESSION['sess_id']}' ";
	mysql_query($sql);	
	}
	if(!empty($_POST['ny_namn']) && !empty($_POST['ny_user'])){
	$sql = "UPDATE members SET namn='{$_POST['ny_namn']}', user='{$_POST['ny_user']}' WHERE id='{$_SESSION['sess_id']}' ";
	mysql_query($sql);	
	}
	header("Location: admin.php?settings");
	exit();
}

//Lägg till ny IP-adress i databasen
if(isset($_POST['submitban'])  && !empty($_POST['ip']) && is_numeric($_POST['ip'])){
	$sql = "INSERT INTO bans SET ip='{$_POST['ip']}', datum='{$datum}'";
	mysql_query($sql);
	header("Location: admin.php?bans");
	exit();
}

//Lägg till ny användare
if(isset($_POST['submituser'])  && !empty($_POST['userny']) && !empty($_POST['namnny']) && !empty($_POST['passny'])){
	$sql = "INSERT INTO members SET user='{$_POST['userny']}', namn='{$_POST['namnny']}', pass='{$_POST['passny']}'";
	mysql_query($sql);
	header("Location: admin.php?users");
	exit();
}

//Lägger till ny nyhet
if(isset($_POST['submitny']) && isset($_SESSION['sess_user'])){
	$sql = "INSERT INTO news SET title='{$_POST['title']}', text='{$_POST['text']}', forfattare='{$_SESSION['sess_namn']}', datum='{$datum}'";
	mysql_query($sql);
	header("Location: index.php");
}

// Uppdaterar nyheten
if(isset($_POST['submiteditny'])){
	$sql = "UPDATE news SET title='{$_POST['title']}', text='{$_POST['text']}', forfattare='{$_POST['forfattare']}', datum='{$_POST['datum']}' WHERE id='{$_GET['id']}'";
	mysql_query($sql);
	header("Location: viewer.php?id=".$_GET['id']."");
}
?>
<script language="JavaScript" type="text/javascript" src="wysiwyg/wysiwyg.js"></script> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?php echo $title;?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<style type="text/css" media="all">@import "style.css";</style>
</head>

<body>
<div id="content">
	<div id="toph"></div>
		<div id="center">
<?php
 
// Om inte inloggad visa formulär, annars logga ut länk 
if (!isset($_SESSION['sess_user'])){
   
// Visa felmeddelande vid felaktig inloggning
if (isset($_GET['badlogin'])){
	echo "Fel användarnamn eller lösenord!<br>\n";
	echo "Försök igen!\n";
  }
?>
<form action="admin.php" method="post">
<label for="user">Användarnamn:</label><br>
<input type="text" name="user" size="18"><br>
<label for="passwd">Lösenord:</label><br>
<input type="password" name="passwd" size="18"><br>
<input type="submit" name="submit" value="Logga in">
</form>
<?php
}
else 
{
?>
<a href='admin.php?logout='>Logga ut</a><br>
<div id='menycontainer'><ul>
	<li><a href='index.php'>Hem</a></li>
	<li><a href='admin.php?settings'>Inställningar</a></li>	
	<li><a href='admin.php?nyheter'>Nyheter</a></li>
	<li><a href='admin.php?add_ny'>Lägg till nyhet</a></li>
	<li><a href='admin.php?users'>Användare</a></li>
	<li><a href='admin.php?bans'>Bannlysningar</a></li>
</ul>
</div>

<?php
}


//Visar inställningarna
if (isset($_GET['settings']) && isset($_SESSION['sess_user'])){
?>
<h1>Sidinställningar</h1>
<form action="admin.php?settings" method="post">
<table width="542">
<tr>
<td width="200" >Antal nyheter per sida:</td>
<td><input type="text" name="antal_ny" value="<?php echo $antal_ny;?>" size="50"></td>
</tr>
<tr>
<td>Antal Kommentarer per sida:</td>
<td><input type="text" name="antal_kom" value="<?php echo $antal_kom;?>" size="50"></td>
</tr>
<tr>
<td>Title:</td>
<td><input type="text" name="title" value="<?php echo $title;?>" size="50"></td>
</tr>
<tr>
</table>
<h1>Användarinställningar</h1>
<table width="542">
<tr>
<td width="200" >Användarnamn:</td>
<td><input type="text" name="ny_user" value="<?php echo $rad['user'];?>" size="50"></td>
</tr>
<tr>
<td width="200" >Namn:</td>
<td><input type="text" name="ny_namn" value="<?php echo $rad['namn'];?>" size="50"></td>
</tr>
<tr>
<td width="200" >Nytt lösenord:</td>
<td><input type="password" name="ny_pass" value="" size="50"></td>
</tr>
</table>
<input type="submit" name="submitsetting" value="Uppdatera">
</form>
<?php	
}


//Visar nyheterna
if (isset($_GET['nyheter']) && isset($_SESSION['sess_user'])){
	$sql = "SELECT *  FROM news ORDER BY id DESC";
	$result = mysql_query($sql);
		echo '<table width="542">
				<tr>
					<td width="20">ID</td>
					<td width="270">Title</td>
					<td>Datum</td><td>Ändra</td>
					<td width="50">Ta bort</td>
				</tr>';
		
	while($rad=mysql_fetch_array($result)){
		  echo '<tr>
					<td>'.$rad['id'].'</td>
					<td><a href="viewer.php?id='.$rad["id"].'">'.$rad['title'].'</a></td>
					<td>'.$rad['datum'].'</td>
					<td><a href="edit.php?id='.$rad["id"].'">Ändra</a></td>
					<td><a href="admin.php?raderany='.$rad["id"].'">Ta bort</a></td>
				</tr>';
}
echo '</table>';
}


//Visar admins
if (isset($_GET['users']) && isset($_SESSION['sess_user'])){
		echo '<table width="542">
				<tr>
					<td width="20">ID</td>
					<td width="150">Användarnamn</td>
					<td>namn</td>
					<td width="50">Ta bort</td>
				</tr>';
	$sql = "SELECT id,user,namn  FROM members ORDER BY id";
	$result = mysql_query($sql);	
		while($rad=mysql_fetch_array($result)){
		echo '<tr>
					<td>'.$rad['id'].'</td>
					<td>'.$rad['user'].'</td>
					<td>'.$rad['namn'].'</td>
					<td><a href="admin.php?raderauser='.$rad["id"].'">Ta bort</a></td>
				</tr>';
}
echo '</table>';
?>
<h1>Lägg till ny admin</h1>
<form action="admin.php" method="post">
<table width="542">
<tr>
<td width="200" >Användarnamn:</td>
<td><input type="text" name="userny" size="50"></td>
</tr>
<tr>
<td>Namn:</td>
<td><input type="text" name="namnny"  size="50"></td>
</tr>
<tr>
<td>Lösenord:</td>
<td><input type="password" name="passny" size="50"></td>
</tr>
<tr>
</table>
<input type="submit" name="submituser" value="Uppdatera">
</form>
<?php	
}


//Visar bannlysningarna
if (isset($_GET['bans']) && isset($_SESSION['sess_user'])){
		echo '<table width="542">
				<tr>
					<td width="20">ID</td>
					<td width="300">IP</td>
					<td>Datum</td>
					<td width="50">Ta bort</td>
				</tr>';
	$sql = "SELECT *  FROM bans ORDER BY id DESC";
	$result = mysql_query($sql);	
		while($rad=mysql_fetch_array($result)){
		echo '<tr>
					<td>'.$rad['id'].'</td>
					<td>'.$rad['ip'].'</td>
					<td>'.$rad['datum'].'</td>
					<td><a href="admin.php?raderaban='.$rad["ip"].'">Ta bort</a></td>
				</tr>';
}
echo '</table>';

if(mysql_num_rows($result)==0){	
		echo 	'<div id="news">Det finns inga bannlysningar ännu.</div><br>';
}
?>
<h1>Lägg till bannlysning</h1>
<form action="admin.php?bans" method="post">
<input type="text" name="ip" value="IP" size="86"><br><br>
<input type="submit" name="submitban" value="Lägg till">
</form>
<?php
}


// Visar lägg till nyhet
if (isset($_GET['add_ny']) && isset($_SESSION['sess_user'])){
?>
	<h1>Lägg till nyhet</h1>
	<form action="admin.php" method="post">
			<label for="user">Title:</label><br>
				<input type="text" name="title" size="86">
			<label for="user">Text:</label><br>
				<div id="textarea"><textarea id="text" class="textarea" name="text"></textarea>
					<script language="JavaScript">
					generate_wysiwyg('text');
					</script> </div>
			<input type="submit" name="submitny" value="Spara">
		</form>
<?php
}

// Visar ändra nyhet
if (isset($_GET['edit_ny']) && isset($_SESSION['sess_user'])){
	
	// hämtar nyheten från databasen
	$sql = "SELECT * FROM news WHERE id='{$_GET['id']}'";
	$result = mysql_query($sql);
	$rad = mysql_fetch_array($result);

	// Lägger in nyheten i variablar
	$title = $rad['title'];
	$text = $rad['text'];
	$forfattare= $rad['forfattare'];
	$datum = $rad['datum'];
?>
	<h1>Ändra nyhet</h1>
<form action="admin.php?edit_ny&id=<?php echo $_GET['id']; ?>" method="post">

<label for="title">Title:</label><br>
			<input type="text" name="title" value="<?php echo $title; ?>" size="86">
<label for="forfattare">Författare:</label><br>
			<input type="text" name="forfattare" value="<?php echo $forfattare; ?>" size="86">
<label for="datum">Datum:</label><br>
			<input type="text" name="datum" value="<?php echo $rad['datum']; ?>" size="86">
<label for="text">Text:</label><br>
			<textarea id="text" name="text">
			<?php echo $text; ?>
			</textarea>
				<script language="JavaScript">
				generate_wysiwyg('text');
				</script> 
			<input type="submit" name="submiteditny" value="Spara">
		</form>
<?php
}
?>


</div>
	<div id="footer"></div>	
		</div>

</body>
</html>

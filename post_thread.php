<?php
include "header.php";
echo "<div id='post_thread'>";

if(!isset($_SESSION['uid'])){
	echo "Du måste vara inloggad för att skapa en artikel, vänligen logga in eller <a href='register.php'>registrera dig</a>";
}
else{
	echo '
		<form method="POST" enctype="multipart/form-data" action="">
		<fieldset>
		
		<table>
		<tr>
			<td><label>Rubrik: </label></td><td><input class="post_thread_text" type="text" name="post_title" /></td>
		</tr>
		<tr>
		<td><label>Kort inledning: </label></td><td><input class="post_thread_text" type="text" name="post_desc" /></td>
		</tr>
		</table>
		
		
		<label>Innehåll: </label><textarea name="post_content" class="mceEditor"></textarea> <br />
		
		<label>Ladda upp tillhörande bilder:</label><br>
		<input type="file" name="upload_pic1" /><br />
		<input type="file" name="upload_pic2" /><br>
		<input type="file" name="upload_pic3" /><br>
		
		<label>Kategori, lista</label><Select name="post_cat">
		<Option VALUE="0">Välj Kategori</option>
		<Option VALUE="1">Inrikes</option>
		<Option VALUE="2">Utrikes</option>
		<Option VALUE="3">Sport</option>
		<Option VALUE="4">Nöje</option>
		
		</Select>;
		<input type="submit" name="post_thread" value="Skicka" />
		<input type="submit" name="post_preview" value="Förhandsgranska" />
		</fieldset>
		</form>
		
	'; 
}
if(isset($_POST['post_thread'])){
	
	
	include_once "lib/file_upload.php";
	
	
	$post_title = htmlspecialchars(trim(mysql_real_escape_string($_POST['post_title'])));
	$post_content = trim(mysql_real_escape_string($_POST['post_content']));
	$post_desc = htmlspecialchars(trim(mysql_real_escape_string($_POST['post_desc'])));
	$post_time = date('Y-m-d H:i:s');
	$post_cat = $_POST['post_cat'];
	
	$sql = "INSERT INTO posts(post_title, post_content, post_desc,post_creator , post_time, post_ip, post_conf, post_cat) 
	VALUES ('$post_title', '$post_content','$post_desc','".$_SESSION['username']."', '$post_time', '".$_SERVER['REMOTE_ADDR']."', '". 0 ."', '$post_cat' )"; 
	
	mysql_query($sql) or die(mysql_error());
	
		$file_rep = array();
	
	foreach($_FILES as $k => $v){
		$file_rep[] = file_upload($k);
	}
	$response = implode("<br>", $file_rep);
	
}
echo "</div>";
include "footer.php";
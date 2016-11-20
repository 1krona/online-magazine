<?php
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

?>
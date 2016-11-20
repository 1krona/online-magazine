<?php

	session_start();
	$connect = mysql_connect('localhost', 'root', '');

	mb_language('uni');
	mb_internal_encoding('UTF-8');
	$db = mysql_select_db('test',$connect);
	mysql_select_db($db);

if(isset($_POST['submit_info'])){
    
	$user_firstname = htmlspecialchars(trim(mysql_real_escape_string($_POST['user_firstname'])));
	$user_lastname = htmlspecialchars(trim(mysql_real_escape_string($_POST['user_lastname'])));
	$user_ip=$_SERVER['REMOTE_ADDR'];
	$user_name = htmlspecialchars(trim(mysql_real_escape_string($_POST['user_name'])));
	$user_email = htmlspecialchars(trim(mysql_real_escape_string($_POST['user_email'])));
	$user_pass = md5(htmlspecialchars(trim(mysql_real_escape_string($_POST['user_pass']."26239b65f54a0a360ea57d26212fa76d"))));
	$user_N = md5('0IOsabGybo77pniu124sdY'.$user_name.'roDtasd8m21I4RTF90'); 
	$brasak = sha1(strtoupper("9aP5sjdn".$user_N."udi17Ol".$user_pass."7V8GyU"));
	$user_time = date('Y-m-d');

	
	
		if(!empty($_POST['user_name']) && !empty($_POST['user_email']) && !empty($_POST['user_pass'])){
			
			if($_POST['user_pass'] == $_POST['user_pass_check'] && strlen($user_name) < 25){
			
			$sql= "INSERT INTO users(user_name,user_pass,user_email,user_date, user_level, user_ip, user_firstname, user_lastname) 
				VALUES('$user_name', '$brasak','$user_email', '$user_time', 0, '$user_ip', '$user_firstname', '$user_lastname')";
				mysql_query($sql) or die(mysql_error());
				header("Location: ../index.php");
			}
			else{
				echo "Du skrev in fel information, försök igen";
			}
		}
		else{
			echo 'Du måste fylla i alla obligatoriska fält';
		}
}



?>
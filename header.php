<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="sv" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<link href="style.css" rel="stylesheet" type="text/css" />
		<title>Folketstidning.se</title>
	<!--TINYMCE-->
	<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript">
	tinyMCE.init({
			mode : "textareas",
			theme : "advanced",
			forced_root_block : false,
			force_br_newlines : true,
			force_p_newlines : false,    
			convert_newlines_to_brs : true,
			editor_selector : "mceEditor",
			editor_deselector : "mceNoEditor",
			width : "750",
			entity_encoding : "raw",
			
			    theme_advanced_toolbar_location : "top",
			theme_advanced_path_location : "bottom",
			theme_advanced_resize_horizontal : false,
			theme_advanced_resizing : true,
			theme_advanced_layout_manager : "SimpleLayout",
			theme_advanced_buttons1 : "bold,italic,underline,link,unlink, format",
			theme_advanced_buttons2 : "numlist, bullist, undo, redo",
			theme_advanced_buttons3 : ""
			
	});
	</script>
	<!---->
	
	</head>
	<body>

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/sv_SE/all.js#xfbml=1&appId=326000755217";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	
<?php
	session_start();
	$connect = mysql_connect('localhost', 'root', '');

	mb_language('uni');
	mb_internal_encoding('UTF-8');
	$db = mysql_select_db('test',$connect);
	mysql_select_db($db);
	
	include "lib/funcs.php";

	
	
	//

	mysql_query("INSERT INTO online (time, ip) VALUES
	(NOW(), '".$_SERVER['REMOTE_ADDR']."')") or die (mysql_error());

	mysql_query("DELETE FROM online WHERE time < ADDDATE(NOW(), INTERVAL - 10 MINUTE)");
	
	
	//
	
	echo
	'<div id="header">
		<a href="index.php"><img src="pics/head.png" alt="Haer ska headern vara" /></a>
		<div class="header_list"><p class=header_list_title>Senaste nyheter</p>';
	
		$sql_get_newest = "SELECT post_title,post_id FROM posts ORDER BY post_time DESC LIMIT 4";
		$res_get_newest = mysql_query($sql_get_newest) or die(mysql_error());
		
		if(mysql_num_rows($res_get_newest) > 0){
			
			while($row_get_newest = mysql_fetch_assoc($res_get_newest)){
				
				
				if (strlen($row_get_newest['post_title']) > 17){
							
							echo "Gör en truncate";
							
						}
				
					$get_newest_post_title =  "<a href='view_post.php?pid=". $row_get_newest['post_id'] ."'>".$row_get_newest['post_title']."</a>";
				
					echo "<div class='header_list_posts'><p>" . $get_newest_post_title . "</p></div>";
			}
			
		}
		
		echo '
			</div>
			<div class="header_list"><div class=header_list_title><p>Läsare just nu</p></div>';
		
			$sql_get_viewers = "SELECT
				p.post_title, p.post_id, 
				COUNT(DISTINCT o.ip) AS count_ip
			FROM
				posts p
			JOIN
				online o ON (o.track = p.post_id)
			WHERE 
				p.post_conf = 1  
			GROUP BY
				p.post_id
			ORDER BY
				count_ip DESC LIMIT 4"
			; 
			$res_get_viewers = mysql_query($sql_get_viewers) or die(mysql_error());
			
			if(mysql_num_rows($res_get_viewers) > 0){
				
				while($row_get_viewers = mysql_fetch_assoc($res_get_viewers)){
						
						if (strlen($row_get_viewers['post_title']) > 17){
							
							echo "geh";
							
						}
						
						$get_viewers_post_title =  "<a href='view_post.php?pid=". $row_get_viewers['post_id'] ."'>".$row_get_viewers['post_title']."</a>";
					
					echo "<div class='header_list_posts'><p>" . $get_viewers_post_title . "</p>".$row_get_viewers['count_ip']."</div>";
			}
			
		}
	
	
	echo '
		</div>
		<div class="header_list"><p class=header_list_title>Nya kommentarer</p>';
	
		$sql_get_newest = "SELECT SUBSTRING(comment_content,1 ,17) AS comment_content FROM comments ORDER BY comment_time DESC LIMIT 4"; // köra join
		$res_get_newest = mysql_query($sql_get_newest) or die(mysql_error());
		
		if(mysql_num_rows($res_get_newest) > 0){
			
			while($row_get_newest = mysql_fetch_assoc($res_get_newest)){
				
					$get_newest_post_title =  "<a href='view_post.php?pid='index.php''>".$row_get_newest['comment_content']."</a>";
				
				echo "<div class='header_list_posts'><p>" . $get_newest_post_title . "..</p></div>";
			}
			
		}
	
	
	echo '
		</div>
	</div>
	<div id="banner_javel">
		<img src="pics/banner_tradedoubler_980x120.jpg" alt="reklam">
	</div>
	<div id="main_menu">';


	echo	'<ul>
			<li>
				<a href="index.php">Start</a>
			</li>
			<li>
			<a href="weekly_posts.php">Populära nyheter</a>
			</li>
			<li>
				<a href="checkup.php">Granskning</a>
			</li>
			<li>
				<a href="post_thread.php">Skriv artikel</a>
			</li>';
			
			
			if(!isset($_SESSION['uid'])){
				echo	'<li><a href="register.php">Registrera dig</a></li>
				
				<li>	
			
			<form method="post" action="index.php">
			<fieldset>
			<input type="text" name="submit_user" />
			<input type="password" name="submit_pass" />
			<input type="submit" name="login" value="Logga in" />
			</fieldset>
			</form>

			</li>
			</ul>';
	
				if(isset($_POST['login'])){
				
				$submit_user = htmlspecialchars(mysql_real_escape_string($_POST['submit_user']));
				$submit_pass = md5(htmlspecialchars(trim(mysql_real_escape_string($_POST['submit_pass']."26239b65f54a0a360ea57d26212fa76d"))));
				$user_N = md5('0IOsabGybo77pniu124sdY'.$submit_user.'roDtasd8m21I4RTF90'); 
				$brasak = sha1(strtoupper("9aP5sjdn".$user_N."udi17Ol".$submit_pass."7V8GyU"));
				
				$sql = "SELECT * FROM users WHERE user_name = '$submit_user' AND user_pass = '$brasak' LIMIT 1";
				$res = mysql_query($sql) or die(mysql_error());
				
					if(mysql_num_rows($res) == 1){
						
						$row= mysql_fetch_assoc($res);
						
						$_SESSION['user_level'] = $row['user_level'];
						$_SESSION['uid'] = $row['user_id'];
						$_SESSION['username'] = $row['user_name'];
						header("Location: index.php");
						exit();
					}
					else{
						echo "Vänligen kontrollera dina uppgifter eller registrera dig.";
						exit();
					}
			}
	}
	else{
		echo '
		<li>
		<a href="">Ladda upp bilder</a>
		</li>		
		<li>
		<a href="user_info.php">Mitt konto</a>
		</li>		
		<li>
		<a href="logout.php">Logga ut</a>
		</li>
		</ul>';
	}
	?>

	</div>
<?php
include "header.php";
echo "
	<div id='user_info'><div id='user_menu'>
		<ol>
			<li>
				<a href=''>Användarinfo
				</a>
			</li>
			<li>
				<a href=''>Meny
				</a>
			</li>
			<li>
				<a href=''>Publicerade artiklar
				</a>
			</li>
			<li>
				<a href=''>Uppladdade bilder
				</a>
			</li>
			<li>
				<a href=''>Meny
				</a>
			</li>";

echo "	
		</ol>
	</div>";
if($_SESSION['user_level'] == 1){
	echo "<a href='admin_mod/admin_panel.php'>Adminpanel</a>";
}
else{
	
	$sql_shit = 
	"
	SELECT 
		us.user_name, 
		(SELECT COUNT(upload_id) FROM upload WHERE upload_by_user = us.user_name) as uploadCount,
		(SELECT COUNT(post_id) FROM posts WHERE post_creator = us.user_name) as postCount, 
		(SELECT SUM(post_views) FROM posts WHERE post_creator = us.user_name) as viewsSum
	FROM users us
		WHERE us.user_name = '".$_SESSION['username']."' ";
	
	$res_shit = mysql_query($sql_shit) or die (mysql_error());
	
	if(mysql_num_rows($res_shit) > 0){
		
		while($row_shit = mysql_fetch_assoc($res_shit)){
		
		echo $row_shit['user_name']. ": <br /> Antal uppladdade foton: " .$row_shit['uploadCount'] . "<br />Publicerade artiklar: " . $row_shit['postCount'] . "<br /> Totala visningar: " . $row_shit['viewsSum'];
		}
	}
	
	$sql_get_info = "SELECT * FROM users WHERE user_id = '".$_SESSION['uid']."' LIMIT 1";
	$res_get_info = mysql_query($sql_get_info) or die (mysql_error());
	
	if(mysql_num_rows($res_get_info) == 1){
		
	$row_get_info = mysql_fetch_assoc($res_get_info);
		
		echo "<table>
				<tr>
					<td>Användarnamn:</td>
					<td>".$row_get_info['user_name']."</td>
				</tr>
				<tr>
					<td>Förnamn:</td>
					<td>".$row_get_info['user_firstname']."</td>
				</tr>
				<tr>
					<td>Efternamn:</td>
					<td>".$row_get_info['user_lastname']."</td>
				</tr>
				<tr>
					<td>Email:</td>
					<td>".$row_get_info['user_email']."</td>
				</tr>
				<tr>
					<td>Registrerad:</td>
					<td>".$row_get_info['user_date']."</td>
				</tr>
			</table>";
		
	}

}

echo "</div>";
include "footer.php";
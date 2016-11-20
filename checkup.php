<?php
include "header.php";

echo '<div id="checkup_content">
		<table>
		
		<th><a href="checkup_denied.php">Nekade artiklar</a></th>
		
		<tr>
		
		<th>Titel</th>
		<th>Publicerad</th>
		
		</tr>';

$sql_list_denied = "SELECT
    post_title, post_time, post_id
FROM
    posts
WHERE
	post_conf = ". 2 ."
ORDER BY
    post_time DESC LIMIT 50";
	
$res_list_denied = mysql_query($sql_list_denied) or die(mysql_error());

if(mysql_num_rows($res_list_denied) > 0){
	while($row_list_denied = mysql_fetch_assoc($res_list_denied)){
		
		$title_list_denied = "<a href='view_post.php?pid=". $row_list_denied['post_id'] ."'>". $row_list_denied['post_title'] . "</a>";
		$time_list_denied = "<a href='view_post.php?pid=". $row_list_denied['post_id'] ."'>". $row_list_denied['post_time'] . "</a>";
		
		echo '
		
		<tr>
		<td> ' . $title_list_denied . ' </td>
		<td> '. $time_list_denied . ' </td>
		</tr>
		';
	}
}



echo '</table>';

//

echo 	'<table>
		
		<th><a href="checkup_unconf.php">Ogranskade artiklar</a></th>
		
		<tr>
		
		<th>Titel</th>
		<th>Publicerad</th>
		
		</tr>';

$sql_list_unconf = "SELECT
    post_title, post_time, post_id
FROM
    posts
WHERE
	post_conf = ". 0 ."
ORDER BY
    post_time DESC LIMIT 50";
	
$res_list_unconf = mysql_query($sql_list_unconf) or die(mysql_error());

if(mysql_num_rows($res_list_unconf) > 0){
	while($row_list_unconf = mysql_fetch_assoc($res_list_unconf)){
		
		$title_list_unconf = "<a href='view_post.php?pid=". $row_list_unconf['post_id'] ."'>". $row_list_unconf['post_title'] . "</a>";
		$time_list_unconf = "<a href='view_post.php?pid=". $row_list_unconf['post_id'] ."'>". $row_list_unconf['post_time'] . "</a>";
		
		echo '
		
		<tr>
		<td> ' . $title_list_unconf . ' </td>
		<td> '. $time_list_unconf . ' </td>
		</tr>
		';
	}
}

echo '</table></div>';

include "footer.php";
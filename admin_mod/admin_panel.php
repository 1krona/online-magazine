<?php
include_once "admin_header.php";
echo '<div id="admin_panel">
			<table>
				<tr>
					<th>
					Titel
					</th>
					<th>
					Tid
					</th>
					<th>
					Rank
					</th>
				</tr>';


$sql_panel = "SELECT post_title, post_time, post_rank, post_id FROM posts WHERE post_conf = '". 1 ."' ORDER BY post_rank DESC LIMIT 20";
$res_panel = mysql_query($sql_panel) or die(mysql_error());

if(mysql_num_rows($res_panel) > 0){
	
	$i = 0;
	
	while($row_panel = mysql_fetch_assoc($res_panel)){
		
		$title = $row_panel['post_title'];
		$time = $row_panel['post_time'];
		$rank = $row_panel['post_rank'];
		$id = $row_panel['post_id'];
		
		echo "
			<tr>
				<td>
				".$title."
				</td>
				<td>
				".$time."
				</td>
				<td>
				 
							<form method='get' action='admin_update_parse.php'>
							<fieldset>
							<input type='text' name='update_post_rank[$i]' value=".$rank." />
						
							<input type='hidden' name='hidden_update_rank_id[$i]' value=".$id." />
							<br /><a href='admin_conf.php?pid_confed=".$id."'>Ändra</a>
							<p>".$id."</p>
				</td>
			</tr>";
			
				
		++$i;	
	}
	
}

echo '<input type="submit" name="send_update_confed_rank" value="uppdatera" />
</fieldset></form></table></div>';
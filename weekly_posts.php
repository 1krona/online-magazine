<?php

include "header.php";

echo '<div id="table_list"><table>
		<th>Flest kommentarer (7 dygn)</th>
		<th>Kommentarer</th>
		<th>Visningar</th>';

		
	$time_minus = strtotime("-1 weeks"); 

	$time_week =	date("Y-m-d H:i:s", $time_minus);
	$time_now = date("Y-m-d H:i:s");
		
$sql_weekly = "SELECT
    p.post_title, p.post_views, p.post_id, 
    COUNT(c.comment_id) post_comment_count
FROM
    posts p
JOIN
    comments c ON (c.comment_on_post_id = p.post_id)
WHERE 
	p.post_conf = 1 
AND
	c.comment_time BETWEEN '".$time_week."'  AND '".$time_now."' 
GROUP BY
    p.post_id
ORDER BY
    post_comment_count DESC LIMIT 5"
;
	
$res_weekly = mysql_query($sql_weekly) or die(mysql_error());

if(mysql_num_rows($res_weekly) > 0){
	while($row_weekly = mysql_fetch_assoc($res_weekly)){
		
		$title_weekly = "<a href='view_comments.php?pid=". $row_weekly['post_id'] ."'>". $row_weekly['post_title'] . "</a>";
		$comment_count_weekly = "<a href='view_comments.php?pid=". $row_weekly['post_id'] ."'>". $row_weekly['post_comment_count'] . "</a>";
		$views_weekly = "<a href='view_comments.php?pid=". $row_weekly['post_id'] ."'>". $row_weekly['post_views'] . "</a>";
		
		echo '
		
		<tr>
		<td> ' . $title_weekly . ' </td>
		<td> '. $comment_count_weekly . ' </td>
		<td> '. $views_weekly . '</td>
		</tr>
		';
	}
}
echo '</table><table>
		<th>Flest läsare just nu</th>
		<th>Läsare</th>
		<th>Visningar</th>';


		
$sql_list_viewers = 
			"SELECT
				p.post_title, p.post_id, p.post_views,
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
				count_ip DESC LIMIT 25"
			; 
	
$res_viewers = mysql_query($sql_list_viewers) or die(mysql_error());

if(mysql_num_rows($res_viewers) > 0){
	while($row_viewers = mysql_fetch_assoc($res_viewers)){
		
		$title_viewers = "<a href='view_comments.php?pid=". $row_viewers['post_id'] ."'>". $row_viewers['post_title'] . "</a>";
		$count_viewers_ip = "<a href='view_comments.php?pid=". $row_viewers['post_id'] ."'>". $row_viewers['count_ip'] . "</a>";
		$views_viewers = "<a href='view_comments.php?pid=". $row_viewers['post_id'] ."'>". $row_viewers['post_views'] . "</a>";
		
		echo '
		
		<tr>
		<td> ' . $title_viewers . ' </td>
		<td> '. $count_viewers_ip . ' </td>
		<td> '. $views_viewers . '</td>
		</tr>
		';
	}
}
		
echo '</table></div>';
include "footer.php";
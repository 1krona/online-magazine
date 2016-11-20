<?php

include "header.php";

$search_res = mysql_real_escape_string(htmlentities($_GET['res']));

echo '<div id="search_res">

<div class="side_div"><div class="side_menu">
<form method="GET" action="search_parse.php">
<input type="text" name="search_value" value="Sök"/>
<input type="submit" name="send_search" value="Gå" />
</form>
<ul>
<li><a href="inrikes.php">Inrikes</a></li>
<li><a href="utrikes.php">Utrikes</a></li>
<li><a href="noje.php">Nöje</a></li>
<li><a href="sport.php">Sport</a></li>
</ul>
</div>
<div class="likebox"><fb:like-box href="http://facebook.com/pages/Drömde-jag-eller-hände-det-på-riktigt/253391487429" width="120" height="398" show_faces="true" border_color="#444" stream="false" header="true"></fb:like-box></div>
</div>';

$sql_search_res = "SELECT post_id, post_title, post_time, SUBSTRING(post_content, 1, 255) AS post_content FROM posts WHERE post_content LIKE '".$search_res."%' ORDER BY post_time DESC";
$res_search_res = mysql_query($sql_search_res) or die (mysql_error());

if(mysql_num_rows($res_search_res) > 0){
	while($row_search_res = mysql_fetch_assoc($res_search_res)){
		$post_title = "<a href='view_post.php?pid=". $row_search_res['post_id'] . "'>" . $row_search_res['post_title'] . "</a>";
		$post_content = "<a href='view_post.php?pid=". $row_search_res['post_id'] . "'>" . $row_search_res['post_content'] . "</a>";
		
		echo "<div id='view_search_res'><h4>".$post_title."</h4><br><p>".$post_content."...</p><span style='float:right; font-size: 10px;'><p>".$row_search_res['post_time']."</p></span></div>";
	}
}
else{
	echo 'Det finns inget resultat';
}
echo "</div>";
include "footer.php";
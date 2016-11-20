<?php
include "../header.php";

$sql_info_posts = "SELECT post_title, post_id, post_views WHERE post_creator = '".$_SESSION['username']."' ORDER BY post_views ASC";


include "../footer.php";
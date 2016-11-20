<?php

$rpp = 10; // results per page
$adjacents = 4;

$page = 1; //intval($_GET["page"]);
if($page<=0) $page = 1;

$reload = $_SERVER['PHP_SELF'];

// connect to your DB:
$link_id = mysql_connect('localhost', 'root', '');
mysql_select_db('test', $link_id);

// select appropriate results from DB:
					$sql_get_comments = "SELECT * FROM comments WHERE comment_on_post_id='3' ORDER BY comment_time DESC";
					$res_get_comments = mysql_query($sql_get_comments) or die(mysql_error());

// count total number of appropriate listings:
$tcount = mysql_num_rows($res_get_comments);

// count number of pages:
$tpages = ($tcount) ? ceil($tcount/$rpp) : 1; // total pages, last page number

$count = 0;
$i = ($page-1)*$rpp;
while(($count<$rpp) && ($i<$tcount)){
						
						 mysql_data_seek($res_get_comments,$i);
						$row_comments = mysql_fetch_assoc($res_get_comments);
						
						$time = $row_comments['comment_time'];
						$user = $row_comments['comment_by'];
						$reg = "2012-01-03";
						$pub = 124524;
						$gen = 78291467125;
						$content = $row_comments['comment_content'];
						
						
						echo "
						<div class='view_comments_comments'>
							<div id='view_comments_head'>
								<p>" . $time ."</p>
							</div>
							<div id='view_comments_user'>
								<h3>".$user. "</h3> <br />
								<p>Reg: ".$reg."</p>
								<p>Publicerade artiklar: ".$pub."</p>
								<p>Genererade visningar: ".$gen."</p>
							</div>
							<p>".$content."</p>
						</div>
						";
						
						$i++;
					$count++;
					}

// call pagination function:
include("sand/pagination3.php");
echo paginate_three($reload, $page, $tpages, $adjacents);
?>
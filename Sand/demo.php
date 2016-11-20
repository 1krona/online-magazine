<?php
/*************************************************************************
php easy :: pagination scripts set - DEMO
==========================================================================
Author:      php easy code, www.phpeasycode.com
Web Site:    http://www.phpeasycode.com
Contact:     webmaster@phpeasycode.com
*************************************************************************/
$page   = intval($_GET['page']);
$tpages = ($_GET['tpages']) ? intval($_GET['tpages']) : 20; // 20 by default
$adjacents  = intval($_GET['adjacents']);

if($page<=0)  $page  = 1;
if($adjacents<=0) $adjacents = 4;

$reload = $_SERVER['PHP_SELF'] . "?tpages=" . $tpages . "&amp;adjacents=" . $adjacents;
?>
<html>
<head>
<title>Pagination DEMO</title>
<link rel="stylesheet" type="text/css" href="paginate.css">
</head>
<body>

<div align="center">
<p><b>Pagination DEMO</b></p>
<form action="<?=$_SERVER['PHP_SELF'];?>" method="get">
<table cellspacing="0" cellpadding="4">
<tr><th>Specify values for pagination test:</th></tr>
<tr><td>total pages: <input type="text" name="tpages" size="2" value="<?=$tpages;?>">,
adjacents: <input type="text" name="adjacents" size="2" value="<?=$adjacents;?>">
<input type="submit" value="Go"></td></tr>
</table>
</form>
<br>
<p><b>View Results for page <?=$page;?> of <?=$tpages;?> (adjacent pages: <?=$adjacents;?>)</b></p>
<p>paginate_one:</p>
<?php
include("pagination1.php");
echo paginate_one($reload, $page, $tpages);
?>
<br>
<p>paginate_two:</p>
<?php
include("pagination2.php");
echo paginate_two($reload, $page, $tpages, $adjacents);
?>
<br>
<p>paginate_three:</p>
<?php
include("pagination3.php");
echo paginate_three($reload, $page, $tpages, $adjacents);

?>
</div>

</body>
</html>

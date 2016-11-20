<?php
/*************************************************************************
php easy :: pagination scripts set - Version One
==========================================================================
Author:      php easy code, www.phpeasycode.com
Web Site:    http://www.phpeasycode.com
Contact:     webmaster@phpeasycode.com
*************************************************************************/
function paginate_one($reload, $page, $tpages) {
	
	$firstlabel = "First";
	$prevlabel  = "Prev";
	$nextlabel  = "Next";
	$lastlabel  = "Last";
	
	$out = "<div class=\"pagin\">\n";
	
	// first
	if($page>1) {
		$out.= "<a href=\"" . $reload . "\">" . $firstlabel . "</a>\n";
	}
	else {
		$out.= "<span>" . $firstlabel . "</span>\n";
	}
	
	// previous
	if($page==1) {
		$out.= "<span>" . $prevlabel . "</span>\n";
	}
	elseif($page==2) {
		$out.= "<a href=\"" . $reload . "\">" . $prevlabel . "</a>\n";
	}
	else {
		$out.= "<a href=\"" . $reload . "&amp;page=" . ($page-1) . "\">" . $prevlabel . "</a>\n";
	}
	
	// current
	$out.= "<span class=\"current\">Page " . $page . " of " . $tpages . "</span>\n";
	
	// next
	if($page<$tpages) {
		$out.= "<a href=\"" . $reload . "&amp;page=" .($page+1) . "\">" . $nextlabel . "</a>\n";
	}
	else {
		$out.= "<span>" . $nextlabel . "</span>\n";
	}
	
	// last
	if($page<$tpages) {
		$out.= "<a href=\"" . $reload . "&amp;page=" . $tpages . "\">" . $lastlabel . "</a>\n";
	}
	else {
		$out.= "<span>" . $lastlabel . "</span>\n";
	}
	
	$out.= "</div>";
	
	return $out;
}
?>
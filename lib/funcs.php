<?php

//truncate text
function truncate($text, $chars) {
//specify number fo characters to shorten by

$text = $text." ";
$text = substr($text,0,$chars);
$text = substr($text,0,strrpos($text,' '));
$text = $text."<span style='color: #0c85d4; text-decoration: underline;'>...</span>";
return $text;
}



?>

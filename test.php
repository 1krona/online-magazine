<?php
 if( !isset ( $_GET['p'] ) ) {$_GET['p'] = 0}
 $per_page = 5;
 $sql = "SELECT f�lt FROM tabell";
 $sql2 = "SELECT f�lt FROM tabell ORDER BY rank DESC LIMIT ".$_GET['p'].",". $per_page;
 $query = mysql_query($sql2);
 $rows = mysql_num_rows ( mysql_query($sql) );
 $pages = ceil( $rows / $per_page );
 
 while( $fetch = mysql_fetch_assoc($query) ){
	echo $fech['inneh�ll'];
 }
 // fixar  sidorna
 for( $i = 0; $i < $pages; $i++ ){
 
	echo ' <a href="index.php?p=' .( $i * $per_page ) . '">'. ( $i + 1 ) .'</a> ';
 
 }
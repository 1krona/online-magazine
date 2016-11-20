<?php

// File upload
function ak_img_resize($target, $newcopy, $w, $h, $ext) {
    list($w_orig, $h_orig) = getimagesize($target);
    $scale_ratio = $w_orig / $h_orig;
    if (($w / $h) > $scale_ratio) {
           $w = $h * $scale_ratio;
    } else {
           $h = $w / $scale_ratio;
    }
    $img = "";
    $ext = strtolower($ext);
    if ($ext == "gif"){ 
    $img = imagecreatefromgif($target);
    } else if($ext =="png"){ 
    $img = imagecreatefrompng($target);
    } else { 
    $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor($w, $h);
    // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
    imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
    if ($ext == "gif"){ 
        imagegif($tci, $newcopy);
    } else if($ext =="png"){ 
        imagepng($tci, $newcopy);
    } else { 
        imagejpeg($tci, $newcopy, 92);
    }
}
///
function ak_img_thumb($target, $newcopy, $w, $h, $ext) {
    list($w_orig, $h_orig) = getimagesize($target);
    $src_x = ($w_orig / 2) - ($w / 2);
    $src_y = ($h_orig / 2) - ($h / 2);
    $ext = strtolower($ext);
    $img = "";
    if ($ext == "gif"){ 
    $img = imagecreatefromgif($target);
    } else if($ext =="png"){ 
    $img = imagecreatefrompng($target);
    } else { 
    $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor($w, $h);
    imagecopyresampled($tci, $img, 0, 0, $src_x, $src_y, $w, $h, $w, $h);
    if ($ext == "gif"){ 
        imagegif($tci, $newcopy);
    } else if($ext =="png"){ 
        imagepng($tci, $newcopy);
    } else { 
        imagejpeg($tci, $newcopy, 92);
    }
}
////
function file_upload($field, $path = "images\\"){
	
	if(is_uploaded_file($_FILES["$field"]['tmp_name'])){
		
		$file_types = array("image/gif", "image/jpeg", "image/png");
		
		if(in_array($_FILES[$field]['type'], $file_types)){
			
			if(file_exists($path . $_FILES[$field]['name'])){
				
				$i = 1;
				
				while(file_exists($path . "(" . $i . ")" . $_FILES[$field]['name'])){
					$i++;
				}
				$_FILES[$field]['name'] = "(" . $i . ")" . $_FILES[$field]['name'];
			
			}
			
			move_uploaded_file($_FILES[$field]['tmp_name'], $path . $_FILES[$field]['name']);
			
		}
		else{
			$_FILES[$field]['error'] = 5;
		}
	}
	//------Jobbar filen--------
	//------------------------
	//------Skickar Svar------
	if($_FILES[$field]['error'] == 5){
		$err = "Filen" . $_FILES[$field]['name'] . "laddades inte upp pga fel typ, godkända typer: <br>";
		foreach($file_types as $type){
			$err .= "-" . strtoupper(substr($type, strpos($type, "/" + 1))) . "<br>";
		}
		return $err;
	}
	else if($_FILES[$field]['error'] == 3){
		if(file_exists($path . $_FILES[$file]['name'])){
			unlink ($path . $_FILES[$file]['name']);
		}
		else{
			echo "Fel vid överföring av fil" . $_FILES[$field]['name'] . ", försök igen";
		}
	}
	else if($_FILES[$field]['error'] == 2 || $_FILES[$field]['error'] == 1){
		return "Filen" . $_FILES[$field]['name'] . "var för stor för att överföra för PHP";
	}
	else if($_FILES[$field]['error'] == 4){
		
	} 
	else{
		
		$time_abo = date('Y-m-d H:i:s');
	
		$sql_post_id = "SELECT post_id FROM posts WHERE post_time= '$time_abo' AND post_ip= '".$_SERVER['REMOTE_ADDR']."' LIMIT 1";
		$res_post_id = mysql_query($sql_post_id) or die(mysql_error());
		
		if(mysql_num_rows($res_post_id) == 1){
			$row_id = mysql_fetch_assoc($res_post_id);
			
			$row_id['post_id'];
		}

	// Tillagt av mig
	
		$type = explode("/", $_FILES[$field]['type']);
	
		$time_abo = date('Y-m-d H:i:s');
	

		ak_img_resize($path ."/". $_FILES[$field]['name'], $path ."/240_". $_FILES[$field]['name'], 240, 480, $type[1]); 
	
		ak_img_resize($path ."/". $_FILES[$field]['name'], $path ."/606_". $_FILES[$field]['name'], 606, 1212, $type[1]); 
	
		$query_abo = "INSERT INTO upload (upload_name, upload_size, upload_type, upload_dir, upload_by_user, upload_to_post_id, upload_dir_606, upload_dir_240 ) ".
		"VALUES ('". $_FILES[$field]['name'] ."', '".$_FILES[$field]['size']."', '".$type[1]."',
		'".$path ."/". $_FILES[$field]['name']."', '".$_SESSION['username']."', '".$row_id['post_id']."', '".$path ."/606_". $_FILES[$field]['name']."', '".$path ."/240_". $_FILES[$field]['name']."' )"; //
		
	
		
		
		
		
		mysql_query($query_abo) or die(mysql_error()); 
	}
}
?>
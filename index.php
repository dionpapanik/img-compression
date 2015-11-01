<?php
if ($handle = opendir('./input')) {
	$images = array();
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
			$images[] = $entry;
            //print_r($images);
        }
    }
    closedir($handle);
}

function compress_image($source_url, $destination_url, $quality) {
	$info = getimagesize($source_url);
	if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
	elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
	elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);
	imagejpeg($image, $destination_url, $quality); //save it
	return $destination_url; //return destination file url
}

if (empty($images)){
	echo "dir empty!";
	die;
}else{
	foreach($images as $img){
		$source_photo = 'input/'.$img;
		$dest_photo = 'output/'.$img;
		$d = compress_image($source_photo, $dest_photo, 70);
		echo $img . " --> OK!</br>";
	}
}
?>

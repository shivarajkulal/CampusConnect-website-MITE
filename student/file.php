<?php
$file=$_GET['file'];
header("content-disposition:attachment; filename=".urlencode($file));
$read=fopen($file, 'r');
while(!feof($read)){

    echo fread($read,8192);
    flush();
}
fclose($read);
?>      
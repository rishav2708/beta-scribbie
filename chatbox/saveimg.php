<?php
//header('Content-type: image/png');
$img=$_POST['canvasImg'];
$to=$_POST['to'];
$l=array('a','b','c')
$from=$_POST['from'];
$img=explode(',',$img);
$decoded=base64_decode($img[1]);
$fp=fopen($to.'.png','w');
fwrite($fp,$decoded);
fclose($fp);
$msg=htmlentities($_POST['msg']);
var_dump($msg);
echo "<img src='".$to.".png' />";
//echo $t;
?>

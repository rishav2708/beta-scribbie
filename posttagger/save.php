<?php
session_start();
$file=fopen('record.txt','a');
fwrite($file,$_POST['see']);
fclose($file);
fclose($file);
header('Location:http://localhost/index.php');
?>

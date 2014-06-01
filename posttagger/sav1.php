<style>

</style>
<body>
<a class='xbutton' href = "javascript:void(0)" onclick = "document.getElementById('show_scribbie').style.display='none';document.getElementById('fade').style.display='none'">X</a>
<?php
$fp=fopen('record.txt','r');
while(!feof($fp))
{
echo fgets($fp);
}
fclose($fp);

?>
</body>

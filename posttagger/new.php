<?
<html>
<style>
#simple_sketch{border:5px solid black;}
a{height:45px;width:45px;}
</style>
<a href="#colors_sketch" data-download="png" onclick="func()" style="float: right; width: 100px;">Download</a>
<form id="form1" name="form1" action="saveimg.php" method="post">
<input type="text" id="canvasImg" name="canvasImg"/>
<input type="submit" value="Submit"/>
</form>
<a href="#simple_sketch" data-color="red" style="float: right; width: 100px;">Red</a>
<a href="#simple_sketch" data-color="blue">Blue</a>
<script src="/ajax/jquery.js"></script>
<script src="sketch.js"></script>
<script src="todataurl.js"></script>
<canvas border=1 id="simple_sketch" width="800" height="300"></canvas>
<script type="text/javascript">
  $(function() {
    $('#simple_sketch').sketch();
  });
function func()
{
//alert("Hi");
var c=document.getElementById("myCanvas");
var dataURL = document.getElementById('simple_sketch').toDataURL();
document.getElementById('canvasImg').value = dataURL;
//alert(dataURL);
}
</script>
</html>

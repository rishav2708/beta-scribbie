<html>
<body>
<style>
#simple_sketch{border:5px solid black;}
</style>
<script src="/ajax/jquery.js"></script>
<script src="sketch.js"></script>
<script type="text/javascript"
   src="ajaxim/js/im.load.js"></script>
<form method="post" action="saveimg.php">
To:<input type='text' id='to' name='to' /></br></br>
From:<input type='text' id='from' name='from' /></br>
<input type="hidden" id="canvasImg" name="canvasImg"></input></br>
<textarea id="msg" name="msg" height=200 width=200></textarea></br>
<canvas border=1 id="simple_sketch" name="simple_sketch" width="300" height="600"></canvas>
<input type="submit" value="Submit" onclick="func()"/>
</form>
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
alert(dataURL);
}
</script>
</body>
</html>

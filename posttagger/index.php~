<?php
session_start();
?>
<html>
<style>
body
{
background:blue;
}
</style>
<a class='xbutton' href = "javascript:void(0)" onclick = "document.getElementById('scribbie_disp').style.display='none';document.getElementById('fade').style.display='none'">X</a>
<body id="body1">
<img src='1.png'></img>
<script type="text/javascript" src="/ajax/jquery.js"></script>
<script type="text/javascript" src="/posttagger/jquery.js"></script>
	<script type="text/javascript" src="/posttagger/raphael.js"></script>
	<script type="text/javascript" src="/posttagger/json2.js"></script>
	<script type="text/javascript" src="/posttagger/raphael.sketchpad.js"></script>
<div class="span-8">
			<h3>Editor</h3>
			<p>
				Draw a sketch below.
			</p>
			<div style="height:260px;" class="widget">
				<div id="sketchpad_editor"></div>
			</div>
		</div>

		<div class="span-8">
			<h3>Result</h3>
			<p>
				The sketch is stored as JSON in an input field.
			</p>
			<form action="save.php" method="post">
				<input type="hidden" id="input1" name="input1" />
			<textarea id="see" name="see"></textarea>
			<input type="submit" id="save" name="save" value="Submit"/>
			</form>
		</div>
<canvas id="div">
See the move
</canvas>
		<div class="span-8 last">
			<h3>Viewer</h3>
			<p>
				<a href="javascript:void(0);" id="update_sketchpad_viewer">Click</a>
				to display the JSON data in the viewer.
			</p>
			<div style="height:260px;" class="widget">
				<div id="sketchpad_viewer"></div>
			</div>
		</div>

		<script type="text/javascript">
var colors=["red","green","blue","yellow","black"];
var i=0;
			$(document).ready(function() {
				var strokes = [];				var sketchpad_editor = Raphael.sketchpad("sketchpad_editor", {
					width: 300,
					height: 240,
					editing: true,	// true is default
					strokes: strokes
				});
var pen=sketchpad_editor.pen();
				sketchpad_editor.change(function() {
					$("#input1").val(sketchpad_editor.json());
pen.color(colors[(i)%4]);
i=(i+1)%4;
				});

				var sketchpad_viewer = Raphael.sketchpad("sketchpad_viewer", {
					width: 300,
					height: 240,
					editing: false
				});

				$("#update_sketchpad_viewer").click(function() {
					sketchpad_viewer.json($('#input1').val());

				});
			});
$('#save').click(function(){
    var svg = $('#sketchpad_viewer').html();
    alert(svg);
    document.getElementById('see').value=svg;
});
var canvas=document.getElementById("div");
canvas.addEventListener('touchmove', function(event) {
  for (var i = 0; i < event.touches.length; i++) {
    var touch = event.touches[i];
    ctx.beginPath();
    ctx.arc(touch.pageX, touch.pageY, 20, 0, 2*Math.PI, true);
    ctx.fill();
    ctx.stroke();
  }
}, false);
</script>
</body>
</html>

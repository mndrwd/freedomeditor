<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Image Editor</title>

	<style type="text/css">@import "ImageEditor.css";</style>
	<script type="text/javascript" src="PageInfo.js"></script>
	<script type="text/javascript" src="ImageEditor.js"></script>
	<script type="text/javascript">
	//<![CDATA[
		if (window.opener){
			window.moveTo(0, 0);
			window.resizeTo(screen.width, screen.height - 28);
			window.focus();
		}
		window.onload = function(){
			ImageEditor.init("<?php echo $_REQUEST["imageName"]; ?>");
		};
	//]]>
	</script>
</head>
<body>

	<div id="image-editor">
		<div class="toolbar">
			<button onclick="ImageEditor.viewOriginal()">View Original</button>
			<button onclick="ImageEditor.viewActive()">View Active</button>
			<button onclick="ImageEditor.save()">Save As Active</button>
			<span class="spacer"> || </span>
			<button onclick="ImageEditor.undo()">Undo/Redo</button>
			<span class="spacer"> || </span>
			w:<input id="txt-width" type="text" size="3" maxlength="4" />
			h:<input id="txt-height" type="text" size="3" maxlength="4" />
			<input id="chk-constrain" type="checkbox" checked="checked" />Constrain
			<button onclick="ImageEditor.resize();">Resize</button>
			<span class="spacer"> || </span>
			<button onclick="ImageEditor.rotate(90)">90&deg;CCW</button>
			<button onclick="ImageEditor.rotate(270)">90&deg;CW</button>
			<span class="spacer"> || </span>
			<button onclick="ImageEditor.crop()">Crop</button>
			<span id="crop-size"></span>
		</div>
		<div class="toolbar">
			<button onclick="ImageEditor.grayscale()">Gray Scale</button>
			<button onclick="ImageEditor.sepia()">Sepia</button>
			<button onclick="ImageEditor.pencil()">Pencil</button>
			<button onclick="ImageEditor.emboss()">Emboss</button>
			<button onclick="ImageEditor.sblur()">Blur</button>
			<button onclick="ImageEditor.smooth()">Smooth</button>
			<button onclick="ImageEditor.invert()">Invert</button>
			<button onclick="ImageEditor.brighten()">Brighten</button>
			<button onclick="ImageEditor.darken()">Darken</button>
		</div>
		<div id="image"></div>
	</div>

</body>
</html>

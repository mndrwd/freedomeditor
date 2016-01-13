function getAbsolutePos(el) {
	var r = { x: el.offsetLeft, y: el.offsetTop };
	if (el.offsetParent) {
		var tmp = getAbsolutePos(el.offsetParent);
		r.x += tmp.x;
		r.y += tmp.y;
	}
	return r;
};

function __dlg_onclose() {
	window.returnValue=null;
};

function __dlg_init(bottom) {
	var body = document.body;
	var body_height = 0;
	if (typeof bottom == "undefined") {
		var div = document.createElement("div");
		body.appendChild(div);
		var pos = getAbsolutePos(div);
		body_height = pos.y;
	} else {
		var pos = getAbsolutePos(bottom);
		body_height = pos.y + bottom.offsetHeight;
	}
	//window.dialogArguments = opener.Dialog._arguments;
	if (!document.all) {
		window.sizeToContent();
		window.sizeToContent();	// for reasons beyond understanding,
					// only if we call it twice we get the
					// correct size.
		window.addEventListener("unload", __dlg_onclose, true);
		// center on parent
		var x = opener.screenX + (opener.outerWidth - window.outerWidth) / 2;
		var y = opener.screenY + (opener.outerHeight - window.outerHeight) / 2;
		window.moveTo(x, y);
		window.innerWidth = body.offsetWidth + 5;
		window.innerHeight = body_height;
	} else {
		window.dialogHeight = body.offsetHeight + 50 + "px";
		window.dialogWidth = body.offsetWidth + "px";
		window.resizeTo(body.offsetWidth, body_height);
		var ch = body.clientHeight;
		var cw = body.clientWidth;
		window.resizeBy(body.offsetWidth - cw, body_height - ch);
		var W = body.offsetWidth;
		var H = 2 * body_height - ch;
		var x = (screen.availWidth - W) / 2;
		var y = (screen.availHeight - H) / 2;
		window.moveTo(x, y);
	}
};

function __dlg_translate(namespace) {
	var spans = document.getElementsByTagName("span");
	for (var i = spans.length; --i >= 0;) {
		var span = spans[i];
		if (span.firstChild && span.firstChild.data) {
			var txt = namespace.I18N[span.firstChild.data];
			if (txt)
				span.firstChild.data = txt;
		}
	}
	var txt = namespace.I18N[document.title];
	if (txt)
		document.title = txt;
};

// closes the dialog and passes the return info upper.
function __dlg_close(val) {
	window.returnValue="#"+val;
	window.close();
};

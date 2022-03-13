function inschar(what)
{
	if (document.selection.type!="Control")
	{
		strPage = "/file/editor/add_char.html";
		strAttr = "status:no;dialogWidth:450px;dialogHeight:290px;help:no";
		html = showModalDialog(strPage, DocObj, strAttr);
		if (html) 
			insertHtml(html);
	}
}

function pickColor(type)
{	
	if (type=='ForeColor') setState(document.all['btnFill'], false);
	if (type=='BackColor') setState(document.all['btnText'], false);			
	var el = window.event.srcElement;
	if (el && el.nodeName == "IMG") {
		setState(el, true);
	}
	document.all['color'].style.left = el.offsetLeft-268;
	document.all['color'].style.top = 100;
	document.all['color'].style.display = 'block';
	document.all['color'].thistype = type;
}

function setColor(name, data)
{ 
	document.all['color'].style.display = 'none';
	if (!data) {
		removeFormat(document.selection.createRange(), document.all['color'].thistype);
	} else {
		checkRange();
		document.execCommand(document.all['color'].thistype, false, data);
	}
	setState(document.all['btnText'], false);
	setState(document.all['btnFill'], false);
	document.all.edit.focus();
	f_save();			
}

function removeFormat(r, name)
{
	var cmd = [ "Bold", "Italic", "Underline", "Strikethrough", "FontName", "FontSize", "ForeColor", "BackColor" ];
	var on = new Array(cmd.length);
	for (var i = 0; i < cmd.length; i++) {
		on[i] = name == cmd[i] ? null : r.queryCommandValue(cmd[i]);
	}
	r.execCommand('RemoveFormat');
	for (var i = 0; i < cmd.length; i++) {
		if (on[i]) r.execCommand(cmd[i], false, on[i]);
	}
}
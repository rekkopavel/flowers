

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
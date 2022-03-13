Группа <a a href=?mod=user&action=g2u&gid={gid}>{gname}</a>
<form action="?mod=access&action=use&gid={gid}" method="post">
<table width="500" border="0" cellspacing="0" cellpadding="5" align="center">
<tr align="center" valign="top" bgcolor="cccccc">
	<td colspan=3>Модуль</td>
</tr>
<!--BEGIN TR-->
<tr align="left" bgcolor="#{color}">
	<td>{name}</td><td><input type="checkbox" name="modul[{name}]" value="1" {checked}></td>
	<td>{comment}</td>
</tr>
<!--END TR-->
<tr align="center" valign="top" bgcolor="cccccc">
	<td colspan=3><input type="submit" value="Применить"></td>
</tr>
</table>
</form>

 Права доступа
<form action="?mod=user&action=accesstogroup&gid={gid}" method="post">
<input type="hidden" name="modul" value="{modul}">
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
<!--BEGIN ACCESS-->
<tr bgcolor="#{color}">
<td><input type="checkbox" name="accessgroup[{name}]" value="1" {checked}></td>
<td>{comment}</td>
</tr>
<!--END ACCESS-->	
<tr>
	<td colspan="2" align="center"><input type="submit" value="применить"></td>
</tr>

</table>

</form>
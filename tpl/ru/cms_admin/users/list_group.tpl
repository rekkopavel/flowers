<form action="?mod=user&action=addgroup" method="post">
<table width="100%" border="0" cellspacing="1" cellpadding="7" align="center">
<tr bgcolor="#c0c0c0">
	<td>������</td>
	<td>�������������</td>
	<td>�������</td>
</tr>
<!--BEGIN TR-->
<tr bgcolor="#{color}">
	<td><a href=?mod=user&action=g2u&gid={id}>{name}</a></td>
	<td><a href=?mod=user&action=editgroup&gid={id}>�������������</a></td>
	<td><a href=?mod=user&action=delgroup&gid={id}>�������</a></td>
</tr>
<!--END TR-->
<tr bgcolor="#c0c0c0">
	<td>������</td>
	<td align="center"> <input type="text" name="group" size="20" maxlength="255"></td>
	<td> <input type="submit" value="��������"></td>
</tr>

</table>
</table>
</form>
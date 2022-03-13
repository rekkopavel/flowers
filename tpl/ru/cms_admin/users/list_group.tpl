<form action="?mod=user&action=addgroup" method="post">
<table width="100%" border="0" cellspacing="1" cellpadding="7" align="center">
<tr bgcolor="#c0c0c0">
	<td>Группа</td>
	<td>Редактировать</td>
	<td>Удалить</td>
</tr>
<!--BEGIN TR-->
<tr bgcolor="#{color}">
	<td><a href=?mod=user&action=g2u&gid={id}>{name}</a></td>
	<td><a href=?mod=user&action=editgroup&gid={id}>Редактировать</a></td>
	<td><a href=?mod=user&action=delgroup&gid={id}>Удалить</a></td>
</tr>
<!--END TR-->
<tr bgcolor="#c0c0c0">
	<td>Группа</td>
	<td align="center"> <input type="text" name="group" size="20" maxlength="255"></td>
	<td> <input type="submit" value="добавить"></td>
</tr>

</table>
</table>
</form>
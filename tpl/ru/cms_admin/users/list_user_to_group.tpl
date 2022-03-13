<a href=?mod=user&action=viewgroup>Список групп</a>
<form action="?mod=user&action=addusertogroup&gid={gid}" method="post">
Группа: <b>{gname}</b>
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
<tr bgcolor="#c0c0c0">
	<td>Логин</td>
	<td>Редактировать</td>
	<td>Удалить</td>
</tr>
<!--BEGIN TR-->
<tr bgcolor="#{color}">
	<td><a href=?mod=user&action=viewuser&gid={gid}&id={id}>{name}</a></td>
	<td><a href=?mod=user&action=edituser&gid={gid}&id={id}>Редактировать</a></td>
	<td><a href=?mod=user&action=delusertogroup&gid={gid}&id={id}>Удалить</a></td>
</tr>
<!--END TR-->

<tr bgcolor="#c0c0c0">
	<td>Логин</td>
	<td align="center"> <input type="text" name="login" size="20" maxlength="16"></td>
	<td> <input type="submit" value="добавить"></td>
</tr>

</table>
</form>
{tplaccess}


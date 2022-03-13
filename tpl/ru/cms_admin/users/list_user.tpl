<form action="?mod=user&action=adduser" method="post">
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
<tr bgcolor="#c0c0c0">
	<td>Логин</td>
	<td>Редактировать</td>
	<td>Удалить</td>
</tr>
<!--BEGIN TR-->
<tr bgcolor="#{color}">
	<td>{login}</td>
	<td><a href=?mod=user&action=edituser&id={id}&page={page}>Редактировать</a></td>
	<td><a href=?mod=user&action=deluser&id={id}&page={page}>Удалить</a></td>
</tr>
<!--END TR-->

<tr bgcolor="#c0c0c0">
	<td>Логин</td>
	<td align="center"> <input type="text" name="login" size="30" maxlength="16"></td>
	<td rowspan="3"> <input type="submit" value="добавить"></td>
</tr>
<tr bgcolor="#c0c0c0">
	<td>Пароль</td>
	<td align="center"> <input type="text" name="password" size="30" maxlength="16"></td>

</tr>
<tr bgcolor="#c0c0c0">
	<td>Email</td>
	<td align="center"> <input type="text" name="email" size="30" maxlength="60"></td>

</tr>


</table>
</form>


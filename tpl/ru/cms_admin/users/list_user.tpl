<form action="?mod=user&action=adduser" method="post">
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
<tr bgcolor="#c0c0c0">
	<td>�����</td>
	<td>�������������</td>
	<td>�������</td>
</tr>
<!--BEGIN TR-->
<tr bgcolor="#{color}">
	<td>{login}</td>
	<td><a href=?mod=user&action=edituser&id={id}&page={page}>�������������</a></td>
	<td><a href=?mod=user&action=deluser&id={id}&page={page}>�������</a></td>
</tr>
<!--END TR-->

<tr bgcolor="#c0c0c0">
	<td>�����</td>
	<td align="center"> <input type="text" name="login" size="30" maxlength="16"></td>
	<td rowspan="3"> <input type="submit" value="��������"></td>
</tr>
<tr bgcolor="#c0c0c0">
	<td>������</td>
	<td align="center"> <input type="text" name="password" size="30" maxlength="16"></td>

</tr>
<tr bgcolor="#c0c0c0">
	<td>Email</td>
	<td align="center"> <input type="text" name="email" size="30" maxlength="60"></td>

</tr>


</table>
</form>


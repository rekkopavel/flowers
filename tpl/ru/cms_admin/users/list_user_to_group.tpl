<a href=?mod=user&action=viewgroup>������ �����</a>
<form action="?mod=user&action=addusertogroup&gid={gid}" method="post">
������: <b>{gname}</b>
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
<tr bgcolor="#c0c0c0">
	<td>�����</td>
	<td>�������������</td>
	<td>�������</td>
</tr>
<!--BEGIN TR-->
<tr bgcolor="#{color}">
	<td><a href=?mod=user&action=viewuser&gid={gid}&id={id}>{name}</a></td>
	<td><a href=?mod=user&action=edituser&gid={gid}&id={id}>�������������</a></td>
	<td><a href=?mod=user&action=delusertogroup&gid={gid}&id={id}>�������</a></td>
</tr>
<!--END TR-->

<tr bgcolor="#c0c0c0">
	<td>�����</td>
	<td align="center"> <input type="text" name="login" size="20" maxlength="16"></td>
	<td> <input type="submit" value="��������"></td>
</tr>

</table>
</form>
{tplaccess}


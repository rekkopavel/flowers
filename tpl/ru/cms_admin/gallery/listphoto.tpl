<!--BEGIN MAIN-->
<a href="?mod=catalog&action=addphoto&cid={pid}">�������� ����</a>
<table width="100%" cellspacing="2" cellpadding="2" border=0 >
<tr >
	<td width="150"> ���� </td>	<td> �����������  </td>
	<td width="40" >&nbsp;</td>
</tr>
{TR}
</table>
<a href=?mod=catalog&cid={parent_id}>�����</a>  

<!--END MAIN-->

<!--BEGIN TR-->
<tr bgcolor="#F0F0F0"><td width="150"> <img src="/UserFiles/gallery/{pid}/__{id}.{type}" alt="" width="150" border="0"></td> 
<td width="300">{comment}&nbsp;</td> 
<td width="40">
<a href="?mod=catalog&action=editphoto&id={id}">�������������</a>
<br><br>
<a href="?mod=catalog&action=listsubphoto&pid={cid}&sid={id}">����������</a>
<br><br>
<a href="?mod=catalog&action=delphoto&id={id}"> ������� </a></td> </tr>
<!--END TR-->

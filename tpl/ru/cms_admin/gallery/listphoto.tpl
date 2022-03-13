<!--BEGIN MAIN-->
<a href="?mod=catalog&action=addphoto&cid={pid}">Добавить фото</a>
<table width="100%" cellspacing="2" cellpadding="2" border=0 >
<tr >
	<td width="150"> Фото </td>	<td> комментарий  </td>
	<td width="40" >&nbsp;</td>
</tr>
{TR}
</table>
<a href=?mod=catalog&cid={parent_id}>Назад</a>  

<!--END MAIN-->

<!--BEGIN TR-->
<tr bgcolor="#F0F0F0"><td width="150"> <img src="/UserFiles/gallery/{pid}/__{id}.{type}" alt="" width="150" border="0"></td> 
<td width="300">{comment}&nbsp;</td> 
<td width="40">
<a href="?mod=catalog&action=editphoto&id={id}">Редактировать</a>
<br><br>
<a href="?mod=catalog&action=listsubphoto&pid={cid}&sid={id}">Субгалерея</a>
<br><br>
<a href="?mod=catalog&action=delphoto&id={id}"> Удалить </a></td> </tr>
<!--END TR-->

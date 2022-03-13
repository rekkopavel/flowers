<!--BEGIN MAIN-->
<script>
function delcatalog(id, pid, name){
 if (confirm('Удалить: \n '+name)) location.href='?mod=catalog&action=delnews&pid='+pid+'&id='+id ; 
 else return false;
}
</script>
<a href=?mod=catalog&action=addnews&cid={cid}>Добавить</a>
<table width="100%" cellspacing="2" cellpadding="2">
<tr align="center" bgcolor="#C0C0C0">
	<td width="90%">Заголовок</td>
	<td colspan=2 width="50"> &nbsp; </td>
	{TR}
</tr>
</table>
<a href=?mod=catalog&cid={parent_id}>Назад</a>
<!--END MAIN-->


<!--BEGIN TR-->
<tr>
<td>{header_news}</td>
<td width="25" align="center"> 
<a href="?mod=catalog&action=edit_{action}&pid={parent_id}&type={action}&id={id}"><img src="images/b_edit.png" alt="Р-ть" border=0></a>
</td>    
<td width="25" align="center">
<a href="#" onclick="delcatalog({id}, {pid}, '{header_news}')"><img src="images/b_drop.png" alt="Удалить" border=0></a>
 </td>
</tr>
<!--END TR-->
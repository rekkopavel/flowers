<!--BEGIN MAIN-->
<script language=JavaScript src=/htmledit/general.js></script><script language=JavaScript src=/htmledit/functions.js></script><script>var DocObjForm = new Object();</script>
<a href="?mod=catalog&action=addsubphoto&cid={pid}&sid={sid}">Добавить фото</a>
<table width="100%" cellspacing="2" cellpadding="2" border=0 >
<tr>
	<td width="150"> Фото </td>
		<td> комментарий  </td>
	<td width="40" >&nbsp;</td>
</tr>
{TR}

	
</table>

<script language=JavaScript src=/htmledit/general.js></script><script language=JavaScript src=/htmledit/functions.js></script><script>var DocObjForm = new Object();</script>
<form action="" name="f1" >
<table width="100%" cellspacing="2" cellpadding="2">






<tr align="center">
	<td>Текст  <a href=#
					onClick="l=document.location.href.lastIndexOf('/');url=document.location.href.substr(0,l+1);eval('reg=/'+url.replace(/\//ig,'\\\/')+'/ig');if(k=sendform('f1','comment',document.all.css.value))document.forms.f1.elements('comment').value=k.replace(reg,'');"
					onMouseOver="this.className = 'hover';"	onMouseOut="this.className = '';">Редактор </a>
						</td>
</tr>
<tr align="center">
	<td><input type=hidden name='css' value='/admin/common/main.css'>
	<TEXTAREA cols="60" rows="10" name="comment">{comment}</TEXTAREA>
	
	</td>


<tr align="center">
	<td><input type="submit" value="Применить"></td>
</tr>
</table>
</form>
<a href=?mod=catalog&cid={parent_id}>Назад</a>  

<!--END MAIN-->

<!--BEGIN TR-->
<tr bgcolor="#F0F0F0"><td width="150"> <img src="/UserFiles/gallery/{pid}/{sid}/__{id}.{type}" alt="" width="150" border="0"></td> 
<td width="300">{comment}&nbsp;</td> 
<td width="40">
<a href="?mod=catalog&action=editsubphoto&pid={pid}&sid={sid}&id={id}">Редактировать</a>
<br><br>
<a href="?mod=catalog&action=delsubphoto&pid={pid}&sid={sid}&id={id}"> Удалить </a></td> </tr>
<!--END TR-->

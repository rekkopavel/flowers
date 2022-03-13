<script language=JavaScript src=/htmledit/general.js></script><script language=JavaScript src=/htmledit/functions.js></script><script>var DocObjForm = new Object();</script>
<form action="" name="f1" method="post" enctype="multipart/form-data">
<table width="100%" cellspacing="2" cellpadding="2">
<tr align="center">
	<td>Фото <font color=red> Формат *.jpg, *.gif</font></td>
</tr>
<tr align="center">
	<td><input type="file" name="photo"></td>
</tr>

<tr align="center">
	<td> ALT </td>
</tr>
<tr align="center">
	<td><input type="text" name="alt" value="{alt}"></td>
</tr>


<tr align="center">
	<td>комментарий  <a href=#
					onClick="l=document.location.href.lastIndexOf('/');url=document.location.href.substr(0,l+1);eval('reg=/'+url.replace(/\//ig,'\\\/')+'/ig');if(k=sendform('f1','comment',document.all.css.value))document.forms.f1.elements('comment').value=k.replace(reg,'');"
					onMouseOver="this.className = 'hover';"	onMouseOut="this.className = '';">Редактор </a>
						</td>
</tr>
<tr align="center">
	<td><input type=hidden name='css' value='/admin/common/main.css'>
	<TEXTAREA cols="60" rows="10" name="comment">{comment}</TEXTAREA>
	
	</td>
<tr align="center">
	<td>Номер <input type="text" name="num" value="{num}" size="3" maxlength="5"></td>
</tr>

<tr align="center">
	<td><input type="submit" value="Применить"></td>
</tr>
</table>
</form>
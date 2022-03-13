<script language=JavaScript src=/htmledit/general.js></script><script language=JavaScript src=/htmledit/functions.js></script><script>var DocObjForm = new Object();</script>  

<form action="" method="post" enctype="multipart/form-data" name="f1" id="f1">
<input type=hidden name='css' value='/admin/common/main.css'>
<input type=hidden name='type' value='{type}'>
<input type="hidden" name="sid" value="{sid}">
<TABLE width="500" border=0>
<tr><td colspan="2">Имя Подкаталога (Обязательно для заполнения)</td></tr>
<tr><td colspan="2">
<input type="text" name="name" size="80" maxlength="250" value="{name}">
</td> </tr>
<tr><td colspan="2">Контент</td></tr>

	
<tr><td colspan="2">
<TEXTAREA cols="60" rows="10" name="description">{description}</TEXTAREA>

</td></tr>
<tr>   <td align="left">&nbsp;</td><td>
		<a href=#
onClick="l=document.location.href.lastIndexOf('/');url=document.location.href.substr(0,l+1);eval('reg=/'+url.replace(/\//ig,'\\\/')+'/ig');if(k=sendform('f1','description',document.all.css.value))document.forms.f1.elements('description').value=k.replace(reg,'');"
					onMouseOver="this.className = 'hover';"	onMouseOut="this.className = '';">Редактор </a>
						
</td></tr>
<tr colspan="2">   <td align="left">Номер отображения <input type="text" name="num" size="3" maxlength="3" value="{num}"></td></tr>
<tr>
<td align="center">
размер каритнки (300 x * пикселей) формат *.jpg
</td>
</tr>
<tr>
<td align="center">
<input type="file" name="banner">
</td>
</tr>

<tr><td colspan="2" align="center"> <input type=submit value="Применить"></td></tr>
	</TABLE> </form>
<a href=# onclick="history.back();">Назад</a> 
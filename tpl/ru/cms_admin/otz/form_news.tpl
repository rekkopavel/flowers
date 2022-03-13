<script language=JavaScript src=/htmledit/general.js></script><script language=JavaScript src=/htmledit/functions.js></script><script>var DocObjForm = new Object();</script>

<form name="f1" action="" method="POST">
<input type=hidden name='css' value='/admin/common/main.css'>

<table width="500" border="0" cellspacing="2" cellpadding="2">
<tr align="center">
	<td>Заголовок отзыва</td>
</tr>
<tr align="center">
	<td><input type="text" name="header_otz" value="{header_otz}" size="60" maxlength="255"></td>
</tr>
<tr align="center">
	<td>дата (гггг-мм-дд чч:мм:сс)</td>
</tr>
<tr align="center">
	<td><input type="text" name="date_otz" value="{date_otz}" size="20" maxlength="19"></td>
</tr>
<tr align="center">
	<td>Автор</td>
</tr>
<tr align="center">
	<td><input type="text" name="autor" value="{autor}" size="20" maxlength="19"></td>
</tr>
<tr align="center">
	<td>Текст отзыва <a href=#
	onClick="l=document.location.href.lastIndexOf('/');url=document.location.href.substr(0,l+1);eval('reg=/'+url.replace(/\//ig,'\\\/')+'/ig');if(k=sendform('f1','content_otz',document.all.css.value))document.forms.f1.elements('content_otz').value=k.replace(reg,'');"
					onMouseOver="this.className = 'hover';"	onMouseOut="this.className = '';">Редактор </a></td>
</tr>
<tr align="center">
	<td>
	<textarea cols="50" rows="5" name="content_otz">{content_otz}</textarea>
	</td>
</tr>
<tr align="center">
	<td>
<input type="submit" value="Применить">
	</td>
</tr>

</table>
</form>
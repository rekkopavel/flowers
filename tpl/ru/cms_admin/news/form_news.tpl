<script language=JavaScript src=/htmledit/general.js></script><script language=JavaScript src=/htmledit/functions.js></script><script>var DocObjForm = new Object();</script>

<form name="f1" action="" method="POST">
<input type=hidden name='css' value='/admin/common/main.css'>

<table width="500" border="0" cellspacing="2" cellpadding="2">
<tr align="center">
	<td>Заголовок новости</td>
</tr>
<tr align="center">
	<td><input type="text" name="header_news" value="{header_news}" size="60" maxlength="255"></td>
</tr>
<tr align="center">
	<td>дата (гггг-мм-дд чч:мм:сс)</td>
</tr>
<tr align="center">
	<td><input type="text" name="date_news" value="{date_news}" size="20" maxlength="19"></td>
</tr>
<tr align="center">
	<td>Анонс новости <a href=#
	onClick="l=document.location.href.lastIndexOf('/');url=document.location.href.substr(0,l+1);eval('reg=/'+url.replace(/\//ig,'\\\/')+'/ig');if(k=sendform('f1','lid_news',document.all.css.value))document.forms.f1.elements('lid_news').value=k.replace(reg,'');"
					onMouseOver="this.className = 'hover';"	onMouseOut="this.className = '';">Редактор </a></td>
</tr>
<tr align="center">
	<td>
	<textarea cols="50" rows="5" name="lid_news">{lid_news}</textarea>
	</td>
</tr>
<tr align="center">
	<td>Текст новости <a href=#
	onClick="l=document.location.href.lastIndexOf('/');url=document.location.href.substr(0,l+1);eval('reg=/'+url.replace(/\//ig,'\\\/')+'/ig');if(k=sendform('f1','content_news',document.all.css.value))document.forms.f1.elements('content_news').value=k.replace(reg,'');"
					onMouseOver="this.className = 'hover';"	onMouseOut="this.className = '';">Редактор </a></td>
</tr>
<tr align="center">
	<td>
	<textarea cols="50" rows="5" name="content_news">{content_news}</textarea>
	</td>
</tr>
<tr align="center">
	<td>
<input type="submit" value="Применить">
	</td>
</tr>

</table>
</form>
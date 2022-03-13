<script language=JavaScript src=/htmledit/general.js></script><script language=JavaScript src=/htmledit/functions.js></script><script>var DocObjForm = new Object();</script>

<FORM name="f1" action="" method="POST">

<table width="100%" cellspacing="2" cellpadding="2" align="center">
<tr align="center"><td>Имя Каталога (Обязательно для заполнения)</td></tr>
<tr align="center"><td>
<input type="text" name="name" size="80" maxlength="250" value="{name}">
</td> </tr>
<tr align="center"><td>Заголовок</td></tr>
<tr align="center"><td>
<input type="text" name="title" size="80" maxlength="250" value="{title}">
</td> </tr>
<tr align="center"><td>Дескрипшен</td></tr>
<tr align="center"><td>
<input type="text" name="description" size="80" maxlength="250" value="{description}">
</td> </tr>
<tr align="center"><td>Ключевые слова</td></tr>
<tr align="center"><td>
<input type="text" name="keywords" size="80" maxlength="250" value="{keywords}">
</td> </tr>
<tr align="center">
	<td> Верхний комментарий  <a href=#
					onClick="l=document.location.href.lastIndexOf('/');url=document.location.href.substr(0,l+1);eval('reg=/'+url.replace(/\//ig,'\\\/')+'/ig');if(k=sendform('f1','header',document.all.css.value))document.forms.f1.elements('header').value=k.replace(reg,'');"
					onMouseOver="this.className = 'hover';"	onMouseOut="this.className = '';">Редактор </a>
						</td>
</tr>
<tr align="center">
	<td>
	<TEXTAREA cols="60" rows="10" name="header">{header}</TEXTAREA>
	
	</td>
</tr>
<tr align="center">
	<td> Нижний комментарий 
	<a href=#
					onClick="l=document.location.href.lastIndexOf('/');url=document.location.href.substr(0,l+1);eval('reg=/'+url.replace(/\//ig,'\\\/')+'/ig');if(k=sendform('f1','footer',document.all.css.value))document.forms.f1.elements('footer').value=k.replace(reg,'');"
					onMouseOver="this.className = 'hover';"	onMouseOut="this.className = '';">Редактор </a>
	</td>
</tr>
<tr align="center">
	<td>
		<TEXTAREA cols="60" rows="10" name="footer">{footer}</TEXTAREA>
	</td>
</tr>
<tr> <td align="center">Номер отображения <input type="text" name="num" size="3" maxlength="3" value="{num}"></td></tr>

<tr align="center">
	<td>
	<input type=hidden name='css' value='/admin/common/main.css'>
		<input type="submit" value="Применить">
	</td>
</tr>
</table>
</form>
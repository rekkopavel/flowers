<script language=JavaScript src=/htmledit/general.js></script><script language=JavaScript src=/htmledit/functions.js></script><script>var DocObjForm = new Object();</script>

<FORM name="f1" action="" method="POST">
<TABLE width="500" border=0>
<tr><td colspan="2">Имя Каталога (Обязательно для заполнения)</td></tr>
<tr><td colspan="2">
<input type="text" name="name" size="80" maxlength="250" value="{name}">
</td> </tr>
<tr><td colspan="2">Заголовок</td></tr>
<tr><td colspan="2">
<input type="text" name="title" size="80" maxlength="250" value="{title}">
</td> </tr>
<tr><td colspan="2">Дескрипшен</td></tr>
<tr><td colspan="2">
<input type="text" name="description" size="80" maxlength="250" value="{description}">
</td> </tr>
<tr><td colspan="2">Ключевые слова</td></tr>
<tr><td colspan="2">
<input type="text" name="keywords" size="80" maxlength="250" value="{keywords}">
</td> </tr>
<tr><td colspan="2">Контент</td></tr>

	
<tr><td colspan="2">
<TEXTAREA cols="60" rows="10" name="textcontent">{content}</TEXTAREA>
<input type=hidden name='css' value='/admin/common/main.css'>
</td></tr>
<tr>   <td align="left">Номер отображения <input type="text" name="num" size="3" maxlength="3" value="{num}"></td><td>
		<a href=#
					onClick="l=document.location.href.lastIndexOf('/');url=document.location.href.substr(0,l+1); eval('reg=/'+url.replace(/\//ig,'\\\/')+'/ig'); if(k=sendform('f1','textcontent',document.all.css.value))document.forms.f1.elements('textcontent').value=k.replace(reg,'');"
					onMouseOver="this.className = 'hover';"	onMouseOut="this.className = '';">Редактор </a>

</td></tr>
<tr><td colspan="2" align="center"> <input type=submit value="Применить"></td></tr>
	</TABLE> </form>
	<a href=?mod=catalog&cid={pid}>Назад</a>
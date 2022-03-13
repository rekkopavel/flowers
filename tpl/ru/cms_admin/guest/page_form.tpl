<script language=JavaScript src=/htmledit/general.js></script><script language=JavaScript src=/htmledit/functions.js></script><script>var DocObjForm = new Object();</script>

<FORM name="f1" action="" method="POST">
<TABLE width="500" border=0>
<tr><td colspan="2">Имя  (Обязательно для заполнения)</td></tr>
<tr><td colspan="2">
<input type="text" name="name" size="80" maxlength="250" value="{name}">
</td> </tr>


<tr><td colspan="2">Контент</td></tr>

	
<tr><td colspan="2">
<TEXTAREA cols="60" rows="10" name="content">{content}</TEXTAREA>
<input type=hidden name='css' value='/admin/common/main.css'>
</td></tr>
<tr>   <td align="left">E-mail <input type="text" name="email" size="20" maxlength="50" value="{email}"></td><td>
		<a href=#
					onClick="l=document.location.href.lastIndexOf('/');url=document.location.href.substr(0,l+1); eval('reg=/'+url.replace(/\//ig,'\\\/')+'/ig'); if(k=sendform('f1','content',document.all.css.value))document.forms.f1.elements('content').value=k.replace(reg,'');"
					onMouseOver="this.className = 'hover';"	onMouseOut="this.className = '';">Редактор </a>

</td></tr>
<tr><td colspan="2">Icq</td></tr>
<tr><td colspan="2">
<input type="text" name="icq" size="80" maxlength="250" value="{icq}">
</td> </tr>
<tr><td colspan="2">Город</td></tr>
<tr><td colspan="2">
<input type="text" name="city" size="80" maxlength="250" value="{city}">
</td> </tr>
<tr><td colspan="2">Координаты</td></tr>
<tr><td colspan="2">
<input type="text" name="contact" size="80" maxlength="250" value="{contact}">
</td> </tr>
<tr><td colspan="2" align="center"> <input type=submit value="Применить"></td></tr>
	</TABLE> </form>
	<a href=?mod=guestНазад</a>
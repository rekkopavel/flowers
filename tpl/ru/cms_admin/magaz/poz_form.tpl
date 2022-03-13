 <script language=JavaScript src=/htmledit/general.js></script><script language=JavaScript src=/htmledit/functions.js></script><script>var DocObjForm = new Object();</script>


<FORM name="f1" action="" method="POST" enctype="multipart/form-data">
<input type="hidden" name="mader" value="{mader}">
<input type="hidden" name="type" value="{type}">
<input type="hidden" name="sid" value="{sid}">

<input type="hidden" name="photo" value="{photo}">
<input type="hidden" name="photo1" value="{photo1}">
<table width="550" border="0" cellspacing="0" cellpadding="5" >
<tr>
	<td>Город:</td>
	<td>Категория:</td>
</tr>
<tr>
	<td valign="bottom"><strong>{typep}</strong></td>
	<td valign="bottom"><strong>{maderp}</strong></td>
</tr>
</table>

<table width="500" border="0" align="left">
<tr><td>Название позиции(Обязательно для заполнения)</td></tr>
<tr><td>
<input type="text" name="name" size="80" maxlength="250" value='{name}'>
</td> </tr>
<tr align="center">
    <td>
	
	<div align="center">Фото <font color=red> Формат *.jpg</font> </div>
	 
<tr>
	<td >Фото1<br><img src="../photos/{type}/{mader}/{sid}/{photo}" alt="{name}" height="140" border="0"><br> <a href="?mod=magaz&action=delpozphoto&poz_id={poz_id}&mader={mader}&type={mader}&photo=photo">Удалить</a><br><input type="file" name="photo"></td></tr>
<tr>
	<td >Фото2<br><img src="../photos/{type}/{mader}/{sid}/{photo1}" alt="{name1}"  height="140" border="0"><br><a href="?mod=magaz&action=delpozphoto&poz_id={poz_id}&mader={mader}&type={mader}&photo=photo1">Удалить</a><br><input type="file" name="photo1"></td>



	</td>
</tr>

<tr align="center">
    <td>Артикул  </td>
</tr>
<tr><td>
<input type="text" name="artikul" size="80" maxlength="250" value="{artikul}">
</td> </tr>

<tr align="center">
    <td>Цена </td>
</tr>
 <tr><td>
<input type="text" name="price" size="80" maxlength="250" value="{price}">
</td> </tr>



<tr align="center">
    <td>Подробное описание </td>
</tr>
<tr align="center">
    <td><a href=#
                    onClick="l=document.location.href.lastIndexOf('/');url=document.location.href.substr(0,l+1); eval('reg=/'+url.replace(/\//ig,'\\\/')+'/ig'); if(k=sendform('f1','description',document.all.css.value))document.forms.f1.elements('description').value=k.replace(reg,'');"
                    onMouseOver="this.className = 'hover';"    onMouseOut="this.className = '';">Редактор </a> </td>
</tr>
 <tr><td>
<TEXTAREA  name="description" rows=10 cols=50>{description}</TEXTAREA>
<input type=hidden name='css' value='/admin/common/main.css'>
</td> </tr>
<tr >   <td align="left">Номер отображения <input type="text" name="num" size="3" maxlength="3" value="{num}"></td></tr>

<tr><td  align="center"> <input type=submit value="Применить"></td></tr>
	</TABLE> </form>
	<div style="clear:both"></div>
	<p><a href=?mod=magaz&action=poz&mader={mader}&type={type}&sid={sid}>Назад</a></p>
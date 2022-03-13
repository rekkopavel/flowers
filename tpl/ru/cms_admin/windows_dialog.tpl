<html>
<head>
  <title>{TITLE}</title>
  <meta http-equiv="Content-Type" content="text/html; charset=windows-1251 ">
</head>

<table width="40%" height="30%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#A8C1CC" style="margin-top : 100px;" valign="middle">
  <tbody>
    <tr>
      <td width="50%" height="50%" align="center" valign="middle">
   <form action="" method="post" enctype="multipart/form-data" name="form" id="form">
 <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td colspan="3" align="center"><div style="margin-top: 20px; margin-bottom: 20px;">Установить прав  для <b>{USER}</b> на <b>{FOLDER_NAME}</b></div></td>
</tr>
<tr bgcolor="#f0f0f0">
	<td><b>Вид</b></td>
	<td align=center><b>Разре-<br>шить</b></td>
		<td align=center><b>Запре-<br>тить</b></td>
</tr>
<tr bgcolor="#c0ff93">
	<td width="50%">Доступ</td>
	<td align=center><input type="radio" name="access" value="1"> </td>
	<td align=center> <input type="radio" name="access" value="0" checked></td>
</tr>

<tr bgcolor="#A8C1CC">
	<td colspan="3">&nbsp;</td>
</tr>
<tr>

<tr bgcolor="#f0f0f0">
	<td colspan="2">К вложенным</td>
	<td align=center> <input type="radio" name="amount" value="all"  checked></td>
</tr>                                                                    
<tr bgcolor="#c0ff93">
	<td colspan="2">К текушей</td>
	<td align=center><input type="radio" name="amount" value="one"></td>
</tr>
</tr>
<tr bgcolor="#A8C1CC">
	<td colspan="3">&nbsp;</td>
</tr>

<tr>
	<td width="50%" colspan="2" align="center"><INPUT Type=button Value="OK" style="font-size: 12px;" onclick="form.submit()"></td>
	<td width="50%" align=center><INPUT Type=button Value="Отмена" style="font-size: 12px;" onClick="location.replace('index.php?mod=users&action=access&uid={UID}')">
</td>
</tr>
<tr bgcolor="#A8C1CC">
	<td colspan="3">&nbsp;</td>
</tr>


</table>
<input type="hidden" name="uid" value="{UID}">
<input type="hidden" name="folder" value="{FOLDER_ID}">
</form>  
 
	  </td>
    </tr>
  </tbody>
</table>

</body>
</html>

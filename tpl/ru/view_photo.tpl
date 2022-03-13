<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<meta name="Description" content="{comment}">
	<meta name="Keywords" content="{alt}">
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
	<link href="global.css" rel="stylesheet" type="text/css">
	<title>{alt}</title>
</head>
<body style="background-color: #301801;">

<table width="500" cellspacing="2" cellpadding="2" align="center">
<tr align="center">
	<td height="100" valign="bottom"><h1>{alt}</h1></td>
</tr>

<tr align="center">
	<td><img src=UserFiles/gallery/{pid}/{sid}/{id}.{type} alt="{alt}" title="{alt}" style="border: #f2c23a thick double"></td>
</tr>
<tr align="center">
	<td>{comment}</td>
</tr>
<tr align="center">
	<td><a href="?action=gallery&id={pid}&photo={lid}">Предыдущая</a> <a href="#" onclick="window.close();">Закрыть</a> <a href="?action=gallery&id={pid}&photo={nid}">Следующая</a><br><br></td>
</tr>

</table>


</body>
</html>
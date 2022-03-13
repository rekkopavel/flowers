

<div align="center"><a href=# onclick="history.back();">Назад</a></div>
	



<br><br>
<form name=f1 action="" method="post" >
<table width="100%" border="0" align="center">

<tr bgcolor=#cccccc><td width="100">Наименование</td><td width="400">Описание</td> <td width="100">Цена</td></tr>
<?   $it = 0;
 $i=0;
if (!empty($_TPL['POZ']))
 foreach($_TPL['POZ'] as $poz){

$row['bgcolor']=($i++%2)?'fffff':'f0f0f0';

?>

<tr <?='bgcolor=#'.$row['bgcolor'] ?>><td ><input type="text" name="name[<?=$poz['poz_id']?>]" value="<?=$poz['name']?>" size="20"></td><td ><textarea cols="40" rows="2" name="desc[<?=$poz['poz_id']?>]" size="50"><?=$poz['description']?></textarea></td><td> <textarea cols="20" rows="1" name="price[<?=$poz['poz_id']?>]" size="50"><?=$poz['price']?></textarea></td>

<?
	$it++;  }
?>

<tr bgcolor=#cccccc><td>Наименование</td><td >Описание</td> <td >Цена</td></tr>
</table>
<br><br>
<div align="center"><input type=submit value="Сохранить"></div>
</form>
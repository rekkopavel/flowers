<!--BEGIN MAIN-->
<style>
	table.korz td{
		border: 1px solid #FBB34E;
		height: 20px;
		vertical-align: top;
		
	}
</style>
<form action="index.php" method="post" name="basket" id="basket" metod="post">
<input type="hidden" name="posted" value="1">
<table border="0" cellspacing="0" width="100%" cellpadding="5" align="center" class="korz" style="border-collapse: collapse;">

<tr>
    <td><h3>Наименование изделия</h3></td>
	<td><h3>Описание</h3></td>
	<td><h3>Производитель</h3></td>
    <td><h3>Артикул</h3></td>
    <td><h3>Цена</h3></td>
    
</tr>
{tr}
</table>



</form>

<!--END MAIN-->

<!--BEGIN TR-->
<tr>
    <td align="center">{name}<br><br>
    <table border="0" cellspacing="0" cellpadding="0" ><tr><td><a href="index.php?action=magaz&mod=full&type={type}&poz_id={poz_id}"><img src="../photos/{mader}/{type}/{year}/{photo}" alt="{name}" height="140" border="0" style="border: 1px solid white;"></a></td></tr></table><br><br>
    </td>
	<td><img src="images/shim.gif" alt="" width="150" height="1" border="0"><br>&nbsp;{description}</td>
    <td>&nbsp;{distr}</td>
    <td>&nbsp;{artikul}</td>
    <td>&nbsp;{price}&nbsp;руб.</td>
  

</tr>

<!--END TR-->
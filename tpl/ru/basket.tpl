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
<table border="0" cellspacing="0" cellpadding="5" align="center" class="korz" style="border-collapse: collapse;">

<tr>
    <td><h3>������������ �������</h3></td>
	<td><h3>��������</h3></td>
	<td><h3>�������������</h3></td>
    <td><h3>�������</h3></td>
    <td><h3>����</h3></td>
    <!--<td><h3>����������</h3></td>-->
    <td><h3>�������</h3></td>
</tr>
{tr}
</table>
<br><br>
<a href="index.php?action=magaz&mod=basket&act=print"><strong>������ ��� ������</strong></a>
<!--<table width="400" cellspacing="1" cellpadding="8" align="center">
<tr>
    <td><b>�.�.�.</b> *

    </td>
    <td>
   <input type="text" name="fio" size="40" maxlength="100" value="">
    </td>
</tr>


<tr>
    <td>Email </td>
    <td>
    <input type="text" name="email" size="40" maxlength="60" value="">
    </td>
</tr>
<tr>
    <td>������� *</td>
    <td>
    <input type="text" name="phone" size="40" maxlength="20" value="">
    </td>
</tr>



<tr>
    <td colspan="2" align="center"><input type="Submit" value="��������� �����"></td>
</tr>
</table>-->


</form>

<!--END MAIN-->

<!--BEGIN TR-->
<tr>
    <td align="center">{name}<br><br>
    <table border="0" cellspacing="0" cellpadding="0" ><tr><td><a href="?action=magaz&mod=full&type={type}&poz_id={poz_id}" title="{name}"><img src="../photos/{mader}/{type}/{year}/{photo}" alt="{name}" height="140" border="0" style="border: 1px solid white;"></a></td></tr></table><br><br>
    </td>
	<td><img src="images/shim.gif" alt="" width="150" height="1" border="0"><br>&nbsp;{description}</td>
    <td>&nbsp;{distr}</td>
    <td>&nbsp;{artikul}</td>
    <td>&nbsp;{price}&nbsp;���.</td>
   <!-- <td ><input type="text" name="kol[{poz_id}]" value="1" size="5"></td>-->
    <td><a href="?action=magaz&mod=basket&del={poz_id}">�������</a></td>

</tr>

<!--END TR-->
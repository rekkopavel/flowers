<!--BEGIN MAIN-->
<div class="mmenu" >
<ul class="nav">
<li><a href="#">��������</a>
        <ul>
                <li><a href="?mod=magaz&action=addpoz&mader={mader}&type={type}&sid={sub_id}">�������</a></li>
                 <li><a href="?mod=magaz&action=import&mader={mader}&type={type}">�������� �� �����</a></li>
        </ul>
</li>
</div>

<table cellspacing="15">
<tr>
	<td><div align="center"><a href=# onclick="history.back();">�����</a></div></td>
	<td><div>
<!--<a href="?mod=magaz&action=editgroup&mader={mader}&type={type}&page={page}">��������� ��������������</a>-->
</div></td>
</tr>
</table>


<script>
function delpoz(poz_id,name,mader,type,sid){
 if (confirm('�������: \n '+name)) location.href='?mod=magaz&action=delpoz&poz_id='+poz_id+'&cid='+mader+'&type='+type+'&sid='+sid;
 else return false;
}

</script>
<br><br>
<table width="100%" border="0" align="center">

<tr bgcolor=#cccccc><td width="15">�</td><td>������������</td><td width="100">�������</td> <td colspan=2>&nbsp;</td></tr>
<!--BEGIN TR-->
<tr bgcolor=#{bgcolor}><td width="15">{num}</td><td>{name}</td><td width="100">{artikul}</td>

<td width="20" align="center">
<a href="?mod=magaz&action=editpoz&poz_id={poz_id}&mader={mader}&type={type}&sid={sub_id}"><img src="images/b_edit.png" alt="�-��" border=0></a>
</td>
<td width="20" align="center">
<a href="#" onclick="delpoz({poz_id},'{name}',{mader},{type},{sub_id})"><img src="images/b_drop.png" alt="�������" border=0></a>
 </td></tr>
<!--END TR-->
<tr bgcolor=#cccccc><td></td><td>���</td><td></td> <td colspan=2>&nbsp;</td></tr>

</table>

<!--END MAIN-->
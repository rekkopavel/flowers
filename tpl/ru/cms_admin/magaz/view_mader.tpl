<!--BEGIN MAIN-->
<div class="mmenu" >
<ul class="nav"> 
<li><a href="#">��������</a> 
	<ul>
		<li><a href="?mod=magaz&action=addcatalog&cid={ID}&type={type}">�������</a></li>

	</ul>
</li>
</div>
<script>
function delmader(id, name){
 if (confirm('�������: \n '+name)) location.href='?mod=magaz&action=delmader&id='+id ;
 else return false;
}

</script>
<br><br>
<table width="100%" border="0" align="center">

<tr bgcolor=#cccccc><td >�</td><td>���</td><td width="30"></td> <td colspan=2>&nbsp;</td></tr>
<!--BEGIN TR-->
<tr bgcolor=#{bgcolor}><td width="15">{num}</td><td><a href="?mod=magaz&action=sub&cid={id}&type={type}">{name}</a></td><td width="30">���������</td>

<td width="20" align="center"> 
<a href="?mod=magaz&action=edit{action}&pid={parent_id}&type={type}&id={id}"><img src="images/b_edit.png" alt="�-��" border=0></a>
</td>
<td width="20" align="center">
<a href="#" onclick="delmader({id},  '{name}')"><img src="images/b_drop.png" alt="�������" border=0></a>
 </td></tr>
<!--END TR-->
<tr bgcolor=#cccccc><td></td><td>���</td><td></td> <td colspan=2>&nbsp;</td></tr>

</table>
<a href=?mod=magaz&cid={PID}>�����</a>  
<!--END MAIN-->


<!--BEGIN MAIN-->
<div class="mmenu" >
<ul class="nav"> 
<li><a href="#">��������</a> 
	<ul>
		<li><a href="?mod=catalog&action=addcatalog&cid={ID}">������</a></li>
		<li><a href="?mod=catalog&action=addgaller&cid={ID}">��������</a></li>  
		 <li><a href="?mod=catalog&action=addnews_rasdel&cid={ID}">��������� ������</a></li>
		 <li><a href="?mod=catalog&action=addserv_rasdel&cid={ID}">������</a></li>
        <!-- <li><a href="?mod=catalog&action=addinfo_rasdel&cid={ID}">����������</a></li> -->
	</ul>
</li>
</div>
<script>
function delcatalog(id, pid, name){
 if (confirm('�������: \n '+name)) location.href='?mod=catalog&action=delcatalog&pid='+pid+'&id='+id ;
 else return false;
}

</script>
<br><br>
<table width="100%" border="0" align="center">

<tr bgcolor=#cccccc><td width="15">�</td><td>���</td><td width="30">���</td> <td colspan=2>&nbsp;</td></tr>
<!--BEGIN TR-->	
<tr bgcolor=#{bgcolor}><td width="15">{num}</td><td><a href="?mod=catalog&cid={id}">{name}</a></td><td width="30">{TYPE}</td> 

<td width="20" align="center"> 
<a href="?mod=catalog&action=edit{action}&pid={parent_id}&type={action}&id={id}"><img src="images/b_edit.png" alt="�-��" border=0></a>
</td>    
<td width="20" align="center">
<!--<a href="#" onclick="delcatalog({id}, {parent_id}, '{name}')"><img src="images/b_drop.png" alt="�������" border=0></a>-->
 </td></tr>
<!--END TR-->
<tr bgcolor=#cccccc><td>�</td><td>���</td><td>���</td> <td colspan=2>&nbsp;</td></tr>

</table>
<a href=?mod=catalog&cid={PID}>�����</a>  
<!--END MAIN-->

<!--BEGIN PHOTO-->
<a href="?mod=catalog&action=listphoto&cid={id}">{name}</a>
<!--END PHOTO-->

<!--BEGIN NEWS-->
<a href="?mod=catalog&action=listnews&cid={id}">{name}</a>
<!--END NEWS-->
<!--BEGIN SERV-->
<a href="?mod=catalog&action=listserv&cid={id}">{name}</a>
<!--END SERV-->
<!--BEGIN INFO-->
<a href="?mod=catalog&action=listinfo&cid={id}">{name}</a>
<!--END INFO-->
<!--BEGIN OTZ-->
<a href="?mod=catalog&action=listotz&cid={id}">{name}</a>
<!--END OTZ-->
<!--BEGIN MAIN-->
<div class="mmenu" >
<ul class="nav"> 
<li><a href="?mod=guest&action=addmessage">Добавить запись</a> 
	
</li>
</div>
<script>
function delmessage(title,id){
 if (confirm('Удалить: \n '+title)) location.href='?mod=guest&action=delmessage&id='+id;
 else return false;
}

</script>
<br><br>
<table width="100%" border="0" align="center">

<tr bgcolor=#cccccc><td width="15">№</td><td>Имя</td><td>E-mail</td><td width="30">Координаты</td> <td colspan=2>&nbsp;</td></tr>
<!--BEGIN TR-->	
<tr bgcolor=#{bgcolor}><td width="15">{num}</td><td><strong>{name}</strong></td><td><strong>{email}</strong></td><td width="30">{contact}</td> 

<td width="20" align="center"> 
<a href="?mod=guest&action=editmessage&id={id}"><img src="images/b_edit.png" alt="Р-ть" border=0></a>
</td>    
<td width="20" align="center">
<a href="#" onclick="delmessage('{title}',{id})"><img src="images/b_drop.png" alt="Удалить" border=0></a>
 </td></tr>
<!--END TR-->
<tr bgcolor=#cccccc><td>№</td><td>Имя</td><td>Заголовок</td><td>Координаты</td> <td colspan=2>&nbsp;</td></tr>

</table>
 
<!--END MAIN-->


<!--BEGIN MAIN-->
<div class="mmenu" >
<ul class="nav"> 
<li><a href="?mod=faq&action=addmessage">Добавить запись</a> 
	
</li>
</div>
<script>
function delmessage(name,id){
 if (confirm('Удалить: \n '+name)) location.href='?mod=faq&action=delmessage&id='+id;
 else return false;
}

</script>
<br><br>
<table width="100%" border="0" align="center">

<tr bgcolor=#cccccc><td width="15">№</td><td>Имя</td><td>Вопрос</td> <td >Опубликовано</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<!--BEGIN TR-->	
<tr bgcolor=#{bgcolor}><td width="15">{num}</td><td><strong>{name}</strong></td><td>{qwestion}</td><td width="30" align="center">{visible}</td> 

<td width="20" align="center"> 
<a href="?mod=faq&action=editmessage&id={id}"><img src="images/b_edit.png" alt="Р-ть" border=0></a>
</td>    
<td width="20" align="center">
<a href="#" onclick="delmessage('{name}',{id})"><img src="images/b_drop.png" alt="Удалить" border=0></a>
 </td></tr>
<!--END TR-->
<tr bgcolor=#cccccc><td>№</td><td>Имя</td><td>Вопрос</td> <td >&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>

</table>
 
<!--END MAIN-->


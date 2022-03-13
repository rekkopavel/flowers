<!--BEGIN MAIN-->
<div class="mmenu" >
<ul class="nav"> 
<li><a href="#">Добавить</a> 
	<ul>
		<li><a href="?mod=catalog&action=addcatalog&cid={ID}">Статью</a></li>
		<li><a href="?mod=catalog&action=addgaller&cid={ID}">Галлерею</a></li>  
		 <li><a href="?mod=catalog&action=addnews_rasdel&cid={ID}">Новостной раздел</a></li>
		 <li><a href="?mod=catalog&action=addserv_rasdel&cid={ID}">Сервис</a></li>
        <!-- <li><a href="?mod=catalog&action=addinfo_rasdel&cid={ID}">Информация</a></li> -->
	</ul>
</li>
</div>
<script>
function delcatalog(id, pid, name){
 if (confirm('Удалить: \n '+name)) location.href='?mod=catalog&action=delcatalog&pid='+pid+'&id='+id ;
 else return false;
}

</script>
<br><br>
<table width="100%" border="0" align="center">

<tr bgcolor=#cccccc><td width="15">№</td><td>Имя</td><td width="30">Тип</td> <td colspan=2>&nbsp;</td></tr>
<!--BEGIN TR-->	
<tr bgcolor=#{bgcolor}><td width="15">{num}</td><td><a href="?mod=catalog&cid={id}">{name}</a></td><td width="30">{TYPE}</td> 

<td width="20" align="center"> 
<a href="?mod=catalog&action=edit{action}&pid={parent_id}&type={action}&id={id}"><img src="images/b_edit.png" alt="Р-ть" border=0></a>
</td>    
<td width="20" align="center">
<!--<a href="#" onclick="delcatalog({id}, {parent_id}, '{name}')"><img src="images/b_drop.png" alt="Удалить" border=0></a>-->
 </td></tr>
<!--END TR-->
<tr bgcolor=#cccccc><td>№</td><td>Имя</td><td>Тип</td> <td colspan=2>&nbsp;</td></tr>

</table>
<a href=?mod=catalog&cid={PID}>Назад</a>  
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
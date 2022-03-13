<!--BEGIN MAIN-->
<div class="mmenu" >
<ul class="nav"> 
<li><a href="#">Добавить</a> 
	<ul>
		<li><a href="?mod=magaz&action=addsub&type={type}&mader={cid}">Подкатегорию</a></li>

	</ul>
</li>
</div>
<script>
function delsub(sid, name,cid,type){
 if (confirm('Удалить: \n '+name)) location.href='?mod=magaz&action=delsub&sid='+sid+'&cid='+cid+'&type='+type;
 else return false;
}

</script>
<br><br>
<table width="100%" border="0" align="center">

<tr bgcolor=#cccccc><td >№</td><td>Имя</td><td width="30"></td> <td colspan=2>&nbsp;</td></tr>
<!--BEGIN TR-->
<tr bgcolor=#{bgcolor}><td width="15">{num}</td><td><a href="#">{name}</a></td><td width="30"><a href="?mod=magaz&action=poz&mader={cid}&sid={sid}&type={type}">Позиии</a></td>

<td width="20" align="center"> 
<a href="?mod=magaz&action=editsub&pid={cid}&type={type}&sid={sid}"><img src="images/b_edit.png" alt="Р-ть" border=0></a>
</td>
<td width="20" align="center">
<a href="#" onclick="delsub({sid},'{name}','{cid}','{type}')"><img src="images/b_drop.png" alt="Удалить" border=0></a>
 </td></tr>
<!--END TR-->
<tr bgcolor=#cccccc><td></td><td>Имя</td><td></td> <td colspan=2>&nbsp;</td></tr>

</table>
<a href=?mod=magaz&cid={PID}>Назад</a>  
<!--END MAIN-->


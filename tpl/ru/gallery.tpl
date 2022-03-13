<!--BEGIN MAIN-->

<style>
div.listphoto{
	height: 350px;
    width: auto;
	overflow: auto;  
}
div.photo{
	height: 450;}
</style>

<table width="100%" border="0" cellspacing="2" cellpadding="2">
<tr >
<td width="160" align="left"> 
<div class="listphoto">
{LISTPHOTO}
</div>
 </td>

<td>
{BPHOTO}
<br>
<div align="center">
{comment}
</div><br>
 </td>

</tr>
</table>


<div class="space"></div>

<!--END MAIN-->
<!--BEGIN LISTPHOTO-->
<table border="0" cellspacing="8">
<tr>
	<td align="left"><div style="BORDER-RIGHT: #f2c23a thick double; BORDER-TOP: #f2c23a thick double; BORDER-LEFT: #f2c23a thick double; BORDER-BOTTOM: #f2c23a thick double; BACKGROUND-COLOR: black" >{sublink}</div></td>
	<td align="left">{comment}</td>
</tr>
</table>


<!--END LISTPHOTO-->
<!--BEGIN BPHOTO-->
<a href="?action=subgallery&id={pid}&sid={sid}" ><img src="UserFiles/gallery/{pid}/{bphoto}" border=0 style="border: thin double #AEE3FF;" alt="{alt}"> </a>
<!--END BPHOTO-->

<!--BEGIN LISTMAIN-->

<!--END LISTMAIN-->
<script language=JavaScript src=/htmledit/general.js></script><script language=JavaScript src=/htmledit/functions.js></script><script>var DocObjForm = new Object();</script>

<form name="f1" action="" method="POST">
<input type=hidden name='css' value='/admin/common/main.css'>

<table width="500" border="0" cellspacing="2" cellpadding="2">
<tr align="center">
	<td>���������</td>
</tr>
<tr align="center">
	<td><input type="text" name="header_info" value="{header_info}" size="60" maxlength="255"></td>
</tr>



	
	

<tr align="center">
	<td>����� <a href=#
					onClick="l=document.location.href.lastIndexOf('/');url=document.location.href.substr(0,l+1);eval('reg=/'+url.replace(/\//ig,'\\\/')+'/ig');if(k=sendform('f1','content_info',document.all.css.value))document.forms.f1.elements('content_info').value=k.replace(reg,'');"
					onMouseOver="this.className = 'hover';"	onMouseOut="this.className = '';">�������� </a></td>
</tr>
<tr align="center">
	<td>
	<textarea cols="50" rows="5" name="content_info">{content_info}</textarea>
	</td>
</tr>
<tr align="center">
	<td>
<input type="submit" value="���������">
	</td>
</tr>

</table>
</form>
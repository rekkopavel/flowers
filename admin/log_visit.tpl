<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>���������� ���������</title>
</head>

<body>
<form action="" method="post">
<textarea cols="60" rows="5" name="query">{QUERY}</textarea>
<input type="submit" value="���������">
</form>
<!-- BEGIN MyOrel.ru Counter -->
<a href=http://www.myorel.ru/>
<img src=http://efactory.ru/counter/counter.php?id=1011
  border=0 width=88 height=31 alt="��� ���">
</a>
<!-- END MyOrel.ru Counter -->

<table border="1" cellspacing="2" cellpadding="2">
<tr>
	<td>
	<b>������</b><br>
	request_uri
	</td>
	<td><b>
	�� ���� ������
        </b><br>
        query_string
	</td>
	<td width="80">
	<b>�����</b></br>
         remote_adress
	</td>
	<td width="80"><b>�����</b><br>
	ut
	</td>
	<td><b>�����</b><br>
	user_agent
	</td>
</tr>
<!--BEGIN TR-->
<tr bgcolor="#{color}">
	<td>{request_uri}</td>
	<td>{query_string}</td>
	<td>{remote_adress}</td>
	<td>{ut}</td>
	<td>{user_agent}</td>
</tr>
<!--END TR-->


</table>




</body>
</html>

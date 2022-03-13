function BtnDown()
{
	window.event.srcElement.style.borderRight = "0.3mm solid white";
		window.event.srcElement.style.borderBottom = "0.3mm solid white";
			window.event.srcElement.style.borderLeft = "0.3mm solid gray";
			window.event.srcElement.style.borderTop = "0.3mm solid gray";
}

function BtnUp()
{	
window.event.srcElement.style.borderRight = "0.3mm solid gray";
		window.event.srcElement.style.borderBottom = "0.3mm solid gray";
			window.event.srcElement.style.borderLeft = "0.3mm solid white";
			window.event.srcElement.style.borderTop = "0.3mm solid white";
}


function blank(stroka)
{
flag=0;
if (stroka) {
	len=stroka.length
	for(i=0;i<len;i++)
	{
		if (stroka.charAt(i)!=" ")
		flag=1;
	}
}
return flag;
}

function go (form,element,css,width,height) 
{
var strAttr = "status:no;dialogWidth:760px;dialogHeight:600px;help:no;scroll:no;";
var ie6 = navigator.appVersion.indexOf("MSIE 7.")>0 || navigator.appVersion.indexOf("MSIE 5.5")>0||navigator.appVersion.indexOf("MSIE 6.")>0;
if(ie6) 
{
blank(form);
if ((form=="")||(blank(form)==0)||(element=="")||(blank(element)==0))
alert("Не задано имя формы или элемента");
else
{
if ((css=="")||(blank(css)==0))
css="nostyle";
if (isNaN(width)==true)
width='100%';
if (isNaN(height)==true)
height='100%';


window.showModalDialog('vas1.htm?'+form+'+'+element+'+'+css+'+'+width+'+'+height,'edit',strAttr);
}
}
else
alert("Для работы в редакторе Вам необходим браузер Internet Explorer версии 5.5 и выше")
}




function sendform (form,element,css,width,height) 
{
var strAttr = "status:no;dialogWidth:760px;dialogHeight:600px;help:no;scroll:no;";
var ie6 = navigator.appVersion.indexOf("MSIE 8.")>0 || navigator.appVersion.indexOf("MSIE 7.")>0 || navigator.appVersion.indexOf("MSIE 5.5")>0||navigator.appVersion.indexOf("MSIE 6.")>0;
if(ie6) 
{
blank(form);
if ((form=="")||(blank(form)==0)||(element=="")||(blank(element)==0))
alert("Не задано имя формы или элемента");
else
{

if ((css=="")||(blank(css)==0))
css="nostyle";
//alert(isNaN(width));
if (isNaN(width)==true)
width='100%';
if (isNaN(height)==true)
height='100%';
DocObjForm.nameform = form;
DocObjForm.text = element;
DocObjForm.css = css;
DocObjForm.editwidth = width;
DocObjForm.editheight = height;
DocObjForm.edit = 'edit';
//docname=''
//alert(document.all['text'].value);
DocObjForm.name=window.document;
DocObjForm.editbody = document.forms[form].elements[element].value;
result=window.showModalDialog('/htmledit/editor.htm?'+form+'+'+element+'+'+css+'+'+width+'+'+height,DocObjForm,strAttr);
return(result);
//window("editor1").document.all.edit.focus(); 
//document.write(document.forms.f1(0).value);
//window.editor.document.all.edit.innertext=document.forms.f1(0).innertext; 
}
}
else
alert("Для работы в редакторе Вам необходим браузер Internet Explorer версии 5.5 и выше")
}



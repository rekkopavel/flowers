
function addtb() 
{
var strAttr = "status:no;dialogWidth:300px;dialogHeight:320px;help:no;scroll:no;";
	if(ie6) 
	{
		if(window.self.document.selection.type=="Control") 
		{
			if(window.self.document.selection.createRange().item(0).tagName=="TABLE")
			{ 
				oTable = window.self.document.selection.createRange().item(0);
				DocObj.tblwidth = oTable.width;
				DocObj.tblheight = oTable.height;
				DocObj.tblborder = oTable.border;
				DocObj.tblborderColor = oTable.borderColor;
				DocObj.tblalign = oTable.align;
				window.showModalDialog('/file/editor/edit_tbl.htm?',DocObj,strAttr)
			}
		} 
		else
			window.showModalDialog('/file/editor/add_tbl.htm?'+cursor(),window.document,strAttr);
	}
	else
		alert("Для работы в редакторе Вам необходим браузер Internet Explorer версии 5.5 и выше")
}

function edittable () 
{
var strAttr = "status:no;dialogWidth:300px;dialogHeight:320px;help:no;scroll:no;";
	if(ie6) 
	{
		nametb=document.selection.id
		window.open('/file/editor/edit_tbl.htm?'+nametb,null,'height=200,width=300');
	}
	else
		alert("Для работы в редакторе Вам необходим браузер Internet Explorer версии 5.5 и выше")
}


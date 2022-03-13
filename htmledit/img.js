function addimg()
{
var strAttr = "status:no;dialogWidth:300px;dialogHeight:360px;help:no;scroll:no;";
	if(ie6)
	{
		if(window.self.document.selection.type=="Control")
		{
			if(window.self.document.selection.createRange().item(0).tagName=="IMG")
			{
				oImg = window.self.document.selection.createRange().item(0);
				DocObj.imgwidth = oImg.width;
				DocObj.imgheight = oImg.height;
				DocObj.imgsrc = oImg.src;
				DocObj.imgalign = oImg.align;
				DocObj.imgalign = oImg.align;
				DocObj.imgalt = oImg.alt;
				DocObj.imghspace = oImg.hspace;
				DocObj.imgvspace = oImg.vspace;
				DocObj.newpic=0;
	window.showModalDialog('add_pic.htm?'+oImg.id+'+'+oImg.width+'+'+oImg.height+'+'+oImg.align+'+'+oImg.src+'+'+oImg.hspace+'+'+oImg.vspace,DocObj,strAttr);
			}
		}
		else
		{
			DocObj.newpic=1;
			window.showModalDialog('add_pic.htm',DocObj,strAttr);
		}
	}
	else
		alert("Для работы в редакторе Вам необходим браузер Internet Explorer версии 5.5 и выше")
}

function addlinkfile(){
 var strAttr = "status:no;dialogWidth:300px;dialogHeight:360px;help:no;scroll:no;";
	if(ie6)
	{
		if(window.self.document.selection.type=="Control")
		{
			if(window.self.document.selection.createRange().item(0).tagName=="IMG")
			{
				//oImg = window.self.document.selection.createRange().item(0);
				//DocObj.imgwidth = oImg.width;
				//DocObj.imgheight = oImg.height;
				DocObj.imgsrc = oImg.src;
				//DocObj.imgalign = oImg.align;
				//DocObj.imgalign = oImg.align;
				//DocObj.imgalt = oImg.alt;
				//DocObj.imghspace = oImg.hspace;
				//DocObj.imgvspace = oImg.vspace;
				//DocObj.newpic=0;
	            window.showModalDialog('add_file.htm?'+oImg.id+'+'+oImg.width+'+'+oImg.height+'+'+oImg.align+'+'+oImg.src+'+'+oImg.hspace+'+'+oImg.vspace,DocObj,strAttr);
			}
		}
		else
		{
			DocObj.newpic=1;
			window.showModalDialog('add_file.htm',DocObj,strAttr);
		}
	}
	else
		alert("Для работы в редакторе Вам необходим браузер Internet Explorer версии 5.5 и выше")
}

function adda()
{
var strAttr = "status:no;dialogWidth:300px;dialogHeight:360px;help:no;scroll:no;";
	if(ie6)
	{
		if(window.self.document.selection.type!="Control")
		{
		var reg = /\s*(&lt;|<){1}\s*a[\w-%#@.,:;\&\\\/=\(\)\[\]?|\"\'\s]*(&gt;|>){1}[\w-%#@.,:;\&\\\/=\(\)\[\]?|\"\'\s]*(&lt;|<){1}\/a(&gt;|>){1}\s*/gi;
		var sel=window.self.document.selection.createRange().htmlText;
		alert(sel);
			if(sel.replace(reg,"regular")=="regular")
			{
				alert('aaa');
			//oA = window.self.document.selection.createRange().item(0);
				var reg1 = /href\s*=\s*[^\s]+(\s|&gt;|>){1}/gi;
				var href=sel.match(reg1);
				alert(href);
				//rgExp.exec(str)
				//if(href!=-1)sel.indexOf('');
				//alert(href.$1);
				//var hr=sel.indexOf('href');
				//var sp;
				//if (hr!=-1) sel.indexOf(' ',hr+1);
				/*
				DocObj.ahref = oA.href;
				DocObj.atarget = oA.target;
				DocObj.imgsrc = oA.src;
				DocObj.imgalign = oA.align;
				DocObj.imgalign = oImg.align;
				DocObj.imgalt = oImg.alt;
				DocObj.imghspace = oImg.hspace;
				DocObj.imgvspace = oImg.vspace;
				DocObj.newpic=0;
	window.showModalDialog('add_pic.htm?'+oImg.id+'+'+oImg.width+'+'+oImg.height+'+'+oImg.align+'+'+oImg.src+'+'+oImg.hspace+'+'+oImg.vspace,DocObj,strAttr);
			*/
			}
		}
		else
		{
			//DocObj.newpic=1;
			//window.showModalDialog('add_pic.htm',DocObj,strAttr);
		}
		alert(sel.replace(reg,"regular"));
	}
	else
		alert("Для работы в редакторе Вам необходим браузер Internet Explorer версии 5.5 и выше")
//alert('asdsadsad');
//if(document.queryCommandValue('Strikethrough'))alert();
}

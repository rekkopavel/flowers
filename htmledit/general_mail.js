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

function GetCurElement(el,make,event)
{
	var sel=document.selection;
	var s=sel.createRange();
	var s_par_id='';
	var s2='';
	var tg_name='';
	document.all['ctlFont'].disabled = document.all['ctlSize'].disabled = false;
	if(sel.type=="Control")
	{
		if(document.selection.createRange().item(0).tagName=="TABLE") 
			{
		
		document.all['ctlFont'].disabled = document.all['ctlSize'].disabled = true;
		

			var oTable = document.selection.createRange().item(0);
			var nRowCount = oTable.rows.length;
			var nColsCount = oTable.rows(0).cells.length;
			tr_id=oTable.rows[nRowCount-1].uniqueID;
			tbl_id=oTable.uniqueID;
			if (el=='column')add_column(nColsCount,tbl_id,'last'); 
			else if (el=='row')add_row(nRowCount,tbl_id,'last');
			}
	 };
}


function hover(on)
{
	var el = window.event.srcElement;
	if (el && !el.disabled && el.nodeName == "IMG" && el.className != "spacer") {
		if (on) {
			if(el.className!='down')el.className = "hover";
			document.all['color'].style.display = 'none';
			setState(document.all['btnText'], false);
			setState(document.all['btnFill'], false);
		} else {
			el.className = el.defaultState ? el.defaultState : null;
		}
	}
}

function press(on)
{
	var el = window.event.srcElement;
	if (el && !el.disabled && el.nodeName == "IMG" && el.className != "spacer") {
		if (on) {
			el.className = "down";
		} else {
			el.className = el.className == "down" ? "hover" : el.defaultState ? el.defaultState : null;
		}
	}
}

function selValue(el, str)
{
	for (var i = 0; i < el.length; i++) {
		if ((!el[i].value && el[i].text == str) || el[i].value == str) {
			el.selectedIndex = i;
			return;
		}
	}
	el.selectedIndex = 0;
}


function setState(el, on)
{
	if (!el.disabled) {
		if (on) {
			el.defaultState = el.className = "down";
		} else {
			el.defaultState = el.className = null;
		}
	}
}


function div_reset(el)
{
	if (!el) document.all['color'].style.display = 'none',setState(document.all['btnText'], false),	setState(document.all['btnFill'], false);	
	if (!el || el == ctlFont)			selValue(document.all['ctlFont'], document.queryCommandValue('FontName'));
	if (!el || el == ctlSize)			selValue(document.all['ctlSize'], document.queryCommandValue('FontSize'));
	if (!el || el == btnBold)			setState(document.all['btnBold'], document.queryCommandValue('Bold'));
	if (!el || el == btnItalic)			setState(document.all['btnItalic'],	document.queryCommandValue('Italic'));
	if (!el || el == btnUnderline)		setState(document.all['btnUnderline'], document.queryCommandValue('Underline'));
	if (!el || el == btnStrikethrough)	setState(document.all['btnStrikethrough'], document.queryCommandValue('Strikethrough'));
	if (!el || el == btnLeftJustify)	setState(document.all['btnLeftJustify'], document.queryCommandValue('JustifyLeft'));
	if (!el || el == btnCenter)			setState(document.all['btnCenter'],	document.queryCommandValue('JustifyCenter'));
	if (!el || el == btnRightJustify)	setState(document.all['btnRightJustify'], document.queryCommandValue('JustifyRight'));
	if (!el || el == btnFullJustify)	setState(document.all['btnFullJustify'], document.queryCommandValue('JustifyFull'));
	if (!el || el == btnNumList)		setState(document.all['btnNumList'], document.queryCommandValue('InsertOrderedList'));
	if (!el || el == btnBulList)		setState(document.all['btnBulList'], document.queryCommandValue('InsertUnorderedList'));
}

function insertHtml(html)
{
	document.focus();
	var sel = document.selection.createRange();
	sel.pasteHTML(html);
	f_save();				
}

function Exec(n) {
if (document.all.saveflag1.checked==true)
f_save();
 		document.all.edit.focus();
		document.execCommand(n,true);
		document.all.edit.focus();
		if (n!="undo"&n!="redo")
		f_save();
				}

			
function checkRange()
{
	document.all.edit.focus();
	if (document.selection.type == "None") {
		document.selection.createRange();
	}else
		f_save();	
	var r = document.selection.createRange();
}

function sel(el)
{
	f_save();				
	checkRange();
	switch(el.id)
	{
	case "ctlFont":
		document.execCommand('FontName', false, el[el.selectedIndex].value);
		break;
	case "ctlSize":
		document.execCommand('FontSize', false, el[el.selectedIndex].value);
		break;
	}
	document.all.edit.focus();
	div_reset();
}

function saveflagf()
{
	if (document.all.saveflag.checked==true)
f_save();
	(document.all.saveflag.checked=false)
}

function f_save() 
{
	if (z==100)
	{
		for(z=0;z<100;z++)
		B[z]=B[z+1];
		B[99]=document.all.edit.innerHTML;
		kol=99
	}
	else
	{
		B[z]=document.all.edit.innerHTML
		kol=z
		z=z+1
	}
	document.all.saveflag1.checked=false;
}

function myundo()
{
	if (document.all.saveflag1.checked==true)
	f_save();
	if(z>1)
	{
		document.all.edit.innerHTML=B[z-2];
		z=z-1;
	}
}

function myredo()
{
	if(z<(kol+1))
	{
		document.all.edit.innerHTML=B[z]
		z=z+1
	}
}

function array1()
{
	str12=""
	for(j=0;j<100;j++)
		str12=str12+"B("+j+")="+B[j]+";"
	alert(str12);
}

function key() 
{
	if (event.ctrlKey && event.shiftKey && event.keyCode == 90)
		myredo();
	else if (event.ctrlKey && event.keyCode == 90)  
	{
		myundo();
		event.returnValue =false;
	}
	else if (event.keyCode == 13||event.keyCode == 32||event.keyCode == 8||event.keyCode == 9||event.keyCode == 46)  
		f_save();
	else if(event.ctrlKey && event.keyCode == 73) 
	{
		if (document.all.saveflag1.checked==true)
		f_save();
		document.execCommand('Italic')
		f_save();
		event.returnValue =false;
	}
	else if(event.ctrlKey && event.keyCode == 66) 
	{
		if (document.all.saveflag1.checked==true)
		f_save();
		document.execCommand('Bold')
		f_save();
		event.returnValue =false;
	}
	else if(event.ctrlKey && event.keyCode == 85) 
	{
		if (document.all.saveflag1.checked==true)
			f_save();
		document.execCommand('Underline')
		f_save();
		event.returnValue =false;
	}
}
   
function flag()
{
	if (event.keyCode != 32&event.keyCode != 13)
		document.all.saveflag1.checked=true
}

function cursor () 
{
	curs=event.clientX;
	return(curs)
}

function foc()
{
document.all.edit.focus();
}



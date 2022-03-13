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
				window.showModalDialog('edit_tbl.htm?',DocObj,strAttr)
			}
		} 
		else
    {
			  document.all.edit.focus();
        rgn = document.selection.createRange();
        if(result=window.showModalDialog('add_tbl.htm?'+cursor(),window.document,strAttr))rgn.pasteHTML(result),save();
    } 
  }
	else
		alert("Для работы в редакторе Вам необходим браузер Internet Explorer версии 5.5 и выше")
}



function mrg_column(tr_id,s_par_index)
{
	document.all[tr_id].cells(s_par_index).innerHTML+=document.all[tr_id].cells(s_par_index+1).innerHTML;					document.all[tr_id].cells(s_par_index).colSpan=document.all[tr_id].cells(s_par_index).colSpan+document.all[tr_id].cells(s_par_index+1).colSpan;
	document.all[tbl_id].rows[tr_id].deleteCell(s_par_index+1);
	save();
}

function mrg_row(tbl_id,tr_index,td_index,td_rowspan)	
{							
	tr_next_id=document.all[tbl_id].rows[tr_index+td_rowspan].uniqueID;
	tr_length=document.all[tbl_id].rows[tr_index].cells.length;
	for(i=0;i<=td_index&&document.all[tr_id].cells(i).colSpan==document.all[tr_next_id].cells(i).colSpan; i++)
	;
	if (--i==td_index)
	{
		document.all[tr_id].cells(i).innerHTML+=document.all[tr_next_id].cells(i).innerHTML;
		document.all[tr_id].cells(i).rowSpan+=1;
		document.all[tbl_id].rows[tr_next_id].deleteCell(i);
		save();
	}
}	

function add_row(n,tbl,last)
{
	if (last=='last') 
		numb=n-1;
	else
		numb=n+1; 
	nColsCount = document.all[tr_id].cells.length;
	var oTr = document.all[tbl].insertRow(n);
	for(var i=0; i<nColsCount; i++) 
	{
		oTr.insertCell();						document.all[tbl].rows[n].cells[i].colSpan=document.all[tbl].rows[numb].cells[i].colSpan;
		document.all[tbl].rows[n].cells[i].innerHTML="&nbsp;&nbsp;";
	}
	save();
}

function del_row(n,tbl)
{
	document.all[tbl].deleteRow(n);
	save();
}

function add_column (n,tbl)
{
	var nRowCount =document.all[tbl].rows.length;
	var nColsCount = document.all[tr_id].cells.length;
	for(i=0; i<nRowCount; i++)
	{ 	
		for(j=n;j>=0&&!document.all[tbl].rows(i).cells(j);j--)
		;
		document.all[tbl].rows(i).insertCell(j);
		document.all[tbl].rows[i].cells[j].innerHTML="&nbsp;&nbsp;";
	}
	save();
}
	
function del_column(n,tbl)
{
	var nRowCount =document.all[tbl].rows.length;
	var nColsCount = document.all[tbl].rows(tr_index).cells.length;
	for(var i=0; i<nRowCount; i++) 
		if (document.all[tbl].rows(i).cells(n)) document.all[tbl].rows(i).deleteCell(n);
	save();
}

function edittable () 
{
var strAttr = "status:no;dialogWidth:300px;dialogHeight:320px;help:no;scroll:no;";
	if(ie6) 
	{
		nametb=document.selection.id
		window.open('edit_tbl.htm?'+nametb,null,'height=200,width=300');
	}
	else
		alert("Для работы в редакторе Вам необходим браузер Internet Explorer версии 5.5 и выше")
}


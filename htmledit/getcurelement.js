function GetCurElement(el,make,event)
{
	var sel=document.selection;
	var s=sel.createRange();
	var s_par_id='';
	var s2='';
	var tg_name='';
	if	(document.all['html'].checked==false)
	{
	 //document.all['ctlFont'].disabled = document.all['ctlSize'].disabled = 	document.all['bPost'].disabled = false;
	}
	if(sel.type=="Control")
	{
		if(document.selection.createRange().item(0).tagName=="TABLE") 
			{
		document.images["addrow"].disabled = false;
		document.images["addrow"].className = '';
		document.images["addcolumn"].disabled = false;
		document.images["addcolumn"].className = '';
		document.images['delcolumn'].disabled=true;
		document.images['delcolumn'].className = 'disabled';
		document.images['delrow'].disabled=true;
		document.images['delrow'].className = 'disabled';
		document.images['mrgcolumn'].disabled=true;
		document.images['mrgcolumn'].className = 'disabled';
		document.images['mrgrow'].disabled=true;
		document.images['mrgrow'].className = 'disabled';
		//document.all['ctlFont'].disabled = document.all['ctlSize'].disabled = 	document.all['bPost'].disabled = true;
		

			var oTable = document.selection.createRange().item(0);
			var nRowCount = oTable.rows.length;
			var nColsCount = oTable.rows(0).cells.length;
			tr_id=oTable.rows[nRowCount-1].uniqueID;
			tbl_id=oTable.uniqueID;
			if (el=='column')add_column(nColsCount,tbl_id,'last'); 
			else if (el=='row')add_row(nRowCount,tbl_id,'last');
				
			
			}
		 };
	else
	{
		s_par=	s.parentElement();
		s_par_uid=	s_par.uniqueID;
		s_par_tagName=s_par.tagName;
		if (document.all[s_par_uid].id) s_par_id=document.all[s_par_uid].id;

		if (document.all[s_par_uid].id) s_par_id=document.all[s_par_uid].id;

		for(tg_name=s_par.tagName;tg_name!='TD'&&s_par_id!='edit'&&s_par_tagName!='BODY';)//&&s_par_id;)
			{
				s_uid=s_par.uniqueID;
				
				s_par=document.all[s_uid].parentElement;
				s_par_uid=s_par.uniqueID;
				tg_name=s_par.tagName;
				s_par_id=s_par.id;
				s_par_tagName=s_par.tagName;

			}		
			if (s_par_id!='edit'&&s_par_tagName!='BODY')
			{
		document.images["addrow"].disabled = false;
		document.images["addrow"].className = '';
		document.images["addcolumn"].disabled = false;
		document.images["addcolumn"].className = '';
		document.images['delcolumn'].disabled=false;
		document.images['delcolumn'].className = '';
		document.images['delrow'].disabled=false;
		document.images['delrow'].className = '';
		document.images['mrgcolumn'].disabled=false;
		document.images['mrgcolumn'].className = '';
		document.images['mrgrow'].disabled=false;
		document.images['mrgrow'].className = '';
		

				s_par_index=s_par.cellIndex

				tr_id=document.all[s_par_uid].parentElement.uniqueID;
				tr_index=document.all[s_par_uid].parentElement.rowIndex;
				tbl_id=document.all[tr_id].parentElement.uniqueID;
				td_index=document.all[s_par_uid].cellIndex;
				td_rowspan=document.all[s_par_uid].rowSpan;	
				if (el=='column')
				{
					td_index=document.all[s_par_uid].cellIndex;
					if(make=='add')					
						add_column(td_index,tbl_id);
					else if (make=='del')
						del_column(td_index,tbl_id);
					else if(make=='mrg'&&s_par.cellIndex<(document.all[tr_id].cells.length-1)&&document.all[tr_id].cells(s_par_index).rowSpan==document.all[tr_id].cells(s_par_index+1).rowSpan)
					mrg_column(tr_id,s_par_index);
					
				}
				else 
				{	 
					tr_index=document.all[s_par_uid].parentElement.rowIndex;
					if(make=='add')					
						add_row(tr_index,tbl_id);
					else if (make=='del')
						del_row(tr_index,tbl_id);
					else if (make=='mrg'&&document.all[tbl_id].rows[tr_index+td_rowspan]&&document.all[tbl_id].rows[tr_index+td_rowspan].cells[td_index])

					mrg_row(tbl_id,tr_index,td_index,td_rowspan);	
					
				}
				
			}
			else{
		disableTblOptions();
		
		
		}
	}
		
}

function disableTblOptions(){
	document.images["addrow"].disabled = true;
	document.images["addrow"].className = 'disabled';
	document.images["addcolumn"].disabled = true;
	document.images["addcolumn"].className = 'disabled';
	document.images['delcolumn'].disabled=true;
	document.images['delcolumn'].className = 'disabled';
	document.images['delrow'].disabled=true;
	document.images['delrow'].className = 'disabled';
	document.images['mrgcolumn'].disabled=true;
	document.images['mrgcolumn'].className = 'disabled';
	document.images['mrgrow'].disabled=true;
	document.images['mrgrow'].className = 'disabled';
}

function status()
{
	setState(document.all['bBold'], document.queryCommandValue('Bold'));
	setState(document.all['bItalic'],	document.queryCommandValue('Italic'));
	setState(document.all['bUnderline'], document.queryCommandValue('Underline'));
	setState(document.all['bStrikethrough'], document.queryCommandValue('Strikethrough'));
	setState(document.all['bLeftJustify'], document.queryCommandValue('JustifyLeft'));
	setState(document.all['bCenter'],	document.queryCommandValue('JustifyCenter'));
	setState(document.all['bRightJustify'], document.queryCommandValue('JustifyRight'));
	setState(document.all['bFullJustify'], document.queryCommandValue('JustifyFull'));
	setState(document.all['bNumList'], document.queryCommandValue('InsertOrderedList'));
	setState(document.all['bBulList'], document.queryCommandValue('InsertUnorderedList'));
        setState(document.all['bSuperscript'], document.queryCommandValue('Superscript'));
        setState(document.all['bSubscript'], document.queryCommandValue('Subscript'));
}

function set_status(name)
{
	setState(document.all[name], document.queryCommandValue(name));
	status();
}

function objects_state()
{
var curEl = window.event.srcElement;
if (curEl.id!='bFont') hideClass(document.all['fonts']),setState(document.all['bFont'],false);
if (curEl.id!='bSize')hideClass(document.all['sizes']),setState(document.all['bSize'],false);
if (curEl.id!='bText')hideClass(document.all['color']),setState(document.all['bText'],false);
if (curEl.id!='bFill')hideClass(document.all['bccolor']),setState(document.all['bFill'],false);
if (curEl.id!='bChar')hideClass(document.all['characters']),setState(document.all['bChar'],false)
}

function hover(on)
{
	var curEl = window.event.srcElement;
	if (curEl && !curEl.disabled && curEl.nodeName == "IMG" && curEl.className != "spacer" && curEl.parentElement && curEl.name!='color_prv'&& curEl.name!='bcolor_prv') {
		if (on) {
			if(curEl.parentElement.className!='down')curEl.parentElement.className = "hover";
			//document.all['color'].style.display = 'none';
			//setState(document.all['bText'], false);
			//setState(document.all['bFill'], false);
		} else {
		//alert(curEl.parentElement.className);
	if (curEl.parentElement.className!='pushed') curEl.parentElement.className=''
//curEl.parentElement.className = curEl.parentElement.defaultState ? curEl.parentElement.defaultState : null;
		}
	}
}

function press(on)
{
	var curEl = window.event.srcElement;
	if (curEl && !curEl.disabled && curEl.nodeName == "IMG" && curEl.className != "spacer" && curEl.parentElement && curEl.name!='color_prv'&& curEl.name!='bcolor_prv' &&curEl.id!='bChar') {
		if (on) {
			curEl.parentElement.className = "down";
		} else {
//		alert('sss');
			if(curEl.parentElement.className == "down") curEl.parentElement.className = "hover";
			//if(curEl.status){
			//alert(curEl.status);
			//if(document.queryCommandValue(curEl.status))curEl.parentElement.className='pushed';
			//}
		}
	}
}


function special_push(curEl)
{
	var nm
	if (curEl.tagName=='TD'){
		if (curEl.className=='modedown')
			curEl.className=''
		else{
//			alert(curEl.name);
			if (curEl.name=="design")document.all.html.className='';
			if (curEl.name=="html")document.all.design.className='';
			curEl.className='modedown';
			}
	}
	else{
	//if(document.queryCommandValue(curEl.status))curEl.parentElement.className=''
		if (curEl.parentElement.className=='pushed')curEl.parentElement.className=''
		else{
			if (curEl.name.indexOf('align')!=-1)
				for(i=1;i<5;i++)
					{
					nm='align'+i;
					if (document.images[nm])document.images[nm].parentElement.className='';
					}
			if (curEl.name.indexOf('list')!=-1)
				for(i=1;i<3;i++)
					{
					nm='list'+i;
					if (document.images[nm])document.images[nm].parentElement.className='';
					}
		curEl.parentElement.className='down';
		}
	}
}

function special_over(curEl)
{
	if (curEl.parentElement.className=='')curEl.parentElement.className='hover'
}

function special_out(curEl)
{
	if (curEl.parentElement.className=='hover') curEl.parentElement.className=''
}

function setState(curEl, on)
{
	if (!curEl.disabled) {
		if (on) {
			//el.defaultState =
			curEl.parentElement.className = "pushed";
		} else {
			//el.defaultState =
			curEl.parentElement.className = null;
		}
	}
}
//Делает невидимым класс
function hideClass(cl)
{
cl.style.display = 'none'
}



function Exec(n) {
	if (document.forms.f0.saveflag1.checked==true)save();
	document.all.edit.focus();
	document.execCommand(n,"trnmfgue");
	document.all.edit.focus();
	if (n!="undo"&n!="redo")
	save();
				}
	function Exec2(n) {
	if (document.forms.f0.saveflag1.checked==true)save();
	document.all.edit.focus();
	document.execCommand(n,"df");
	document.all.edit.focus();
	if (n!="undo"&n!="redo")
	save();
				}			

function range()
{
	document.all.edit.focus();
	if (document.selection.type == "None")document.selection.createRange();
	else
	save();
}

//get Selected Color---------------------------------------------------------------------------------

function getSelColor(tp)
{
var curCl=document.queryCommandValue(tp);
var byteB=curCl%256;
var byteG=Math.floor(curCl/256)%256
var byteR=Math.floor(curCl/256/256)
var newcurCl=byteB*256*256+byteG*256+byteR
return newcurCl;
}

//HTML/design-mode-------------------------------------------------------------------------------------------

function replUrls(body) {
	url=document.location.href.substr(7);
	l=url.indexOf('/');
	url='http://'+url.substr(0,l);
	eval('reg=/'+url.replace(/\//ig,'\\\/')+'/ig');
	return body.replace(reg,'');
}
function HTMLcolor(body) {
	body=replUrls(body);
	var reg = /(&lt;\/?[\sa-z]+[\w-%#@\.,\:\;\\\/=\(\)\[\]\?|\"\'\s]*&gt;)/gi;  //"
	body = body.replace(reg,"<span class=general_tg>$1</span>");
	//form
	reg = /<span class=general_tg>(&lt;\/?\s*(form|input|textarea|select|option){1}[\w-%#@.,:;\\\/=\(\)\[\]?|\"\'\s]*&gt;)<\/span>/gi;
	body = body.replace(reg,"<span class=form_tg>$1</span>");
	//table
	reg = /<span class=general_tg>(&lt;\/?\s*(table|tbody|th|tr|td){1}[\w-%#@.,:;\\\/=\(\)\[\]?|\"\'\s]*&gt;)<\/span>/gi;
	body = body.replace(reg,"<span class=table_tg>$1</span>");
	//a
	reg = /<span class=general_tg>(&lt;\/?\s*a[\w-%#@.,:;\&\\\/=\(\)\[\]?|\"\'\s]*&gt;)<\/span>/gi;
	body = body.replace(reg,"<span class=a_tg>$1</span>");
	//img
	reg = /<span class=general_tg>(&lt;\/?\s*img[\w-%#@.,:;\\\/=\(\)\[\]?|\"\'\s]*&gt;)<\/span>/gi;
	body = body.replace(reg,"<span class=img_tg>$1</span>");
	//script
	reg = /<span class=general_tg>(&lt;\/?\s*script[\w-%#@.,:;\\\/=()\[\]?|\"\'\s]*&gt;)<\/span>/gi;
	body = body.replace(reg,"<span class=script_tg>$1</span>");
	//comments
	reg = /<span class=general_tg>(&lt;\/?\s*(form|input|textarea|select|option){1}[\w-%#@.,:;\\\/=\(\)\[\]?|\"\'\s]*&gt;)<\/span>/gi;
	body = body.replace(reg,"<span class=comments_tg>$1</span>");
	return body;
}

function html(){
	var img_length=document.images.length;
	for(i=0;i<img_length;i++){
		if (document.images[i].menu=='on')document.images[i].disabled = true,document.images[i].className = 'disabled';
	}
	edit.style.fontSize = "14px";
	edit.style.fontFamily = "Courier";
	edit.innerText = edit.innerHTML;
	edit.innerHTML = HTMLcolor(edit.innerHTML);
}

function design(){
	var img_length=document.images.length;
	for(i=0;i<document.images.length;i++){
		document.images[i].disabled = false;
		document.images[i].className = '';
		disableTblOptions();
	}
	edit.style.fontSize = "14px";
	edit.style.fontFamily = "Verdana";
	edit.innerHTML =edit.innerText;
}

//Show objects-----------------------------------------------------------------------------------------

function showfcolors()
{
	var curEl = window.event.srcElement;
	if (curEl && curEl.nodeName == "IMG") {
		setState(curEl, true);
	}
	document.all['color'].style.left = 394;
	document.all['color'].style.display = 'inline';
}

function showbcolors()
{
	var curEl = window.event.srcElement;
	if (curEl && curEl.tagName == "IMG") {
		setState(curEl, true);
	}
	document.all['bccolor'].style.left = 436;
	document.all['bccolor'].style.display = 'inline';
}

function showfonts()
{
	setState(document.all['bFont'],true);
	document.all['fonts'].style.left = 312;
	document.all['fonts'].style.display = 'inline';
	document.all['fonts'].choosefont(document.queryCommandValue('FontName'));
}

function showsizes()
{
	setState(document.all['bSize'],true);
	document.all['sizes'].style.left = 352;
	document.all['sizes'].style.display = 'inline';
	document.all['sizes'].choosesize(document.queryCommandValue('FontSize'));
}

function showcharacters()
{
	var curEl = window.event.srcElement;
	if (curEl && curEl.tagName == "IMG") {
		setState(curEl, true);
	}
	document.all['characters'].style.left = 400;
	document.all['characters'].style.display = 'inline';
}

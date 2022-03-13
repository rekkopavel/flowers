

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
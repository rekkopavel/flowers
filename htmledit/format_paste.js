function GoodTag(t)
{
		return	t.toLowerCase()=="<p" ||
			t.toLowerCase()=="<p" ||
			t.toLowerCase()=="</p" ||
			t.toLowerCase()=="<b" ||
			t.toLowerCase()=="</b" ||
			t.toLowerCase()=="<strong" ||
			t.toLowerCase()=="</strong" ||
			t.toLowerCase()=="<i" ||
			t.toLowerCase()=="</i" ||
			t.toLowerCase()=="<em" ||
			t.toLowerCase()=="</em" ||
			t.toLowerCase()=="<u" ||
			t.toLowerCase()=="</u" ||
			t.toLowerCase()=="<br" ||
			t.toLowerCase()=="</br" ||
			t.toLowerCase()=="<br" ||
			t.toLowerCase()=="</br" ||
			t.toLowerCase()=="<dl" ||
			t.toLowerCase()=="</dl" ||
			t.toLowerCase()=="<dt" ||
			t.toLowerCase()=="</dt" ||
			t.toLowerCase()=="<dd" ||
			t.toLowerCase()=="</dd" ||
			t.toLowerCase()=="<table " ||
			t.toLowerCase()=="<table" ||
			t.toLowerCase()=="</table" ||
			t.toLowerCase()=="<tr" ||
			t.toLowerCase()=="<tr" ||
			t.toLowerCase()=="</tr" ||
			t.toLowerCase()=="<td" ||
			t.toLowerCase()=="<td" ||
			t.toLowerCase()=="</td" ||
			t.toLowerCase()=="<th" ||
			t.toLowerCase()=="<th" ||
			t.toLowerCase()=="</th" ||
			t.toLowerCase()=="<li" ||
			t.toLowerCase()=="</li" ||
			t.toLowerCase()=="<ul" ||
			t.toLowerCase()=="<ul" ||
			t.toLowerCase()=="</ul" ||
			t.toLowerCase()=="<ol" ||
			t.toLowerCase()=="<ol" ||
			t.toLowerCase()=="</ol"||
			t.toLowerCase()=="<div"||
			t.toLowerCase()=="</div"||
			t.toLowerCase()=="<tbody"||
			t.toLowerCase()=="</tbody"||
			t.toLowerCase()=="<img";

}


function ClearHTML(cl){
var s1=""
while(cl.indexOf("<")>=0){

first = cl.indexOf("<");
last = cl.indexOf(">",first);
s=cl.substring(first,last+1);
blank=s.indexOf(" ");
if (blank==-1)
blank=s.length-1
tag=s.substring(0,blank);
if(GoodTag(tag)==false)
{
s=""
}
if(s.indexOf("style")>=0&s!="")
{
style_pos=s.indexOf("style");
style_start_pos=s.indexOf('"');
style_end_pos=s.indexOf('"',style_start_pos+1);
s=s.substring(0,style_pos)+s.substring(style_end_pos+1)//+cl.substring(last+1);
}

if(s.indexOf("class")>=0&s!="")
{
class_pos=s.indexOf("class");
class_ravn=s.indexOf("=",class_pos);
f=0;
for(i=class_pos+5; i<class_ravn;i++)
	{
if (s.charAt(i)!=" ")
		{
i=class_ravn;
f=1

		}
	}
if (f!=1)
	{


for(i=(class_ravn+1); i<(s.length-1);i++)
		{
if (s.charAt(i)!=" ")
			{
class_start_pos=i;
class_end_pos=s.indexOf(" ",class_start_pos)-1;
if (class_end_pos<0)
class_end_pos=(s.length-2)
i=s.length-1;
			}
		}
s=s.substring(0,class_pos)+s.substring(class_end_pos+1)
	}
}
s1=s1+cl.substring(0,first)+s+" ";
cl=cl.substring(last+1);
}
return s1;

}
function optimize()
{
if (document.forms.f0.saveflag1.checked==true)
save();
	r= frm.document.body.createTextRange(); 
	r.execCommand('Paste'); 
	k=frm.document.body.innerHTML;
	s = ClearHTML(k);
	rgn = document.selection.createRange();
	rgn.pasteHTML(s);
	save();
	return false;
}
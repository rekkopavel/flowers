startList = function() {

  if (document.all&&document.getElementById) {
	   var a=document.getElementsByTagName("ul");
	   for(j=0; j<a.length; j++)  {
	     if (a[j].className=='nav'){
    	      navRoot=a[j];
    	          	for (i=0; i<navRoot.childNodes.length; i++) {
				node = navRoot.childNodes[i];
				if (node.nodeName=="LI") {
		  	           node.onmouseover=function() {
   	  			    this.className+=" over";
		 	    	   }
                                   node.onmouseout=function() {
   				       this.className=this.className.replace(" over", "");
				   }
			        }
                   }
	      }              
       }
  }
 
} 
window.onload=startList;

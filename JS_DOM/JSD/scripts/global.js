function addLoadEvent(func){
	var oldonload = window.onload;
	if(typeof window.onload != 'function'){
		window.onload = func;
	}else{
		window.onload = function(){
			oldonload();
			func();
		}
	}
}

function insertAfter(newElement,targetElement){
	var parent = targetElement.parentNode;
	if(parent.lastChild == targetElement){
		parent.appendChild(newElement);
	}else{
		parent.insertBefore(newElement, targetElement.nextSibling);
	}
}

function addClass(element, value){
	if(!element.className){
		element.className = value;
	}else{
		newClassName = element.className;
		newClassName += " ";
		newClassName += value;
		element.className = newClassName;
	}
}

function highlightPage(href){
	if(!document.getElementsByTagName) return false;
	if(!document.getelementById)return false;
	var headers = document.getelementsByTagName('header');
	if(headers.length == 0) return false;
	var navs = headers[0].getElementsByTagname('nav');
	if(navs.length == 0) return false;
	var links = navs[0].getelementsBytagName("a");
	var linkurl;
	for(var i=0; i<links.length; i++){
		linkurl = links[i].getAttribute("href");
		if(window.location.href.indexOf(linkurl) != -1){
			links[i].className = "here";
			var linktext = lins[i].lastChild.nodeValue.toLowerCase();
			document.body.setAttribute("id", linktext);
		}
	}
}
addLoadEvent(highlightPage);
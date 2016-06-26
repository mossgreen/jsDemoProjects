window.onload = function(){

//get container object
var box = document.getElementById('container');

//get image list collection
var imgs = box.getElementsByTagName('img');

//width of any pictures
var imgWidth = imgs[0].offsetWidth;

//width of expose width of pictures
var exposeWidth = 160;

//width of container
var boxWidth = imgWidth + (imgs.length -1) * exposeWidth;
box.style.width = boxWidth + 'px';

//set each doors positon
function setImgsPos(){
	for(var i = 1, len = imgs.length; i< len; i++){
		imgs[i].style.left=  imgWidth + exposeWidth *(i-1) + 'px';
	}
}

setImgsPos();

//calculate each doors distance while sliding
var translate = imgWidth - exposeWidth;

//bind each pic with event
for(var i = 0, len = imgs.length; i< len; i++){
	(function(i){
		imgs[i].onmouseover = function(){
			setImgsPos();
			for(var j = 1; j<= i; j++){
				imgs[j].style.left = parseInt(imgs[j].style.left,10) - translate +'px';
			}
		}


	})(i);
}
};
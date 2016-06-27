

function myReady(fn){

	if(document.addEventListener){
		document.addEventListener("DOMContentLoaded", fn, false)
	}else{
		IEContentLoaded(fn);
	}

	//mimic IE environment
	function IEContentLoaded(fn){
		var d = window.document;
		var done = false;

		var init = function(){
			if(!done){
				done = true;
				fn();
			}
		};

		(function(){
			try{
				d.documentElement.doscroll('left');
			}catch(e){
				setTimeout(arguments.callee,50);
				return ;
			}

			init();
		})();

		//loading status
		d.onreadystatechange = function(){
			if(d.readyState == 'complete'){
				d.onreadystatechange == null;
				init();
			}
		}
	}
}
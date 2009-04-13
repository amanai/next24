window.attachEvent("onload", mmwidth);  
window.attachEvent("onresize", mmwidth);  
function mmwidth(){
	document.getElementById("main").style.width = ((document.documentElement.clientWidth ||  document.body.clientWidth) < 980) ? "980px" :  ((document.body.clientWidth > 1600) ? "1600px" : "auto");
	};  
 
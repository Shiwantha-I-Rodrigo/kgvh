function reDirect(path) {
	window.location = path;
};

function setActive(){
	var path = window.location.pathname;
	var page = path.split("/").pop();
	var element = document.getElementById(page);
	element.classList.add("active");
	// element.classList.remove("otherclass");
};
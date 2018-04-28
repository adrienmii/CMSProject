

function toggleNav() {
   $("#sideBar").toggleClass("menuClose");
   $("#pageContent").toggleClass("menuClose");		   
}	

function toggleMenuMobile() {
  	$("#navBarMobile").toggleClass("menuMobileClose");
}

function toggleSearchMobile() {
  	$("#divInputSearchMobile").toggleClass("divInputSearchMobileClose");
}


function showNotify() {
    var x = document.getElementById("notify");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
}


function showNotify(message) {	
    var notify = document.getElementById("notify");
    notify.innerHTML = message;
    notify.className = "show";
    setTimeout(function(){ notify.className = notify.className.replace("show", ""); }, 5000);
}



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


function showNotify() {
    var x = document.getElementById("notify");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
}

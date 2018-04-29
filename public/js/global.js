

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

function showNotify(message, type = "default") {	
	$("#notifications").addClass("show");
    $("#notifications").append("<div id='ntf' class='ntf ntf-"+type+"'>"+message+"</div>");
    setTimeout(function(){ 
    	$("#notifications").removeClass("show");
	}, 10000);	
}




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

function toggleProfile(that) {

	var getTypeSelected = that.getAttribute("id");				
	$("#profileAdmin").removeClass("active");
	$("#profileStudent").removeClass("active");
	$("#profileTeacher").removeClass("active");
	$("#"+getTypeSelected).addClass("active");


	if(getTypeSelected=="profileStudent"){
		selectRank.value = 3 ;
	}else if(getTypeSelected=="profileTeacher"){
		selectRank.value = 2 ;
	}else{
		selectRank.value = 1 ;
	}
}

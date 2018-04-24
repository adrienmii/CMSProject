
$(document).ready(function() {

   	$("#navBar ul li a").click(function () {
   		$("#navBar ul li").find("active").removeClass("active");
        $(this).parent().addClass("active");
    });
    

});



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
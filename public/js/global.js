

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
    var notifications = document.getElementById("notifications");
    notifications.innerHTML += "<div id='ntf' class='ntf ntf-"+type+" show' style='text-align: right;margin-top: 10px; padding: 15px;float: right;clear: right;'>"+message+"</div>";
    var ntf = document.getElementsByClassName("ntf");
    setTimeout(function(){ for (var i = 0; i < ntf.length; i++){
        ntf[i].style.display = 'none';
    } }, 10000);
}



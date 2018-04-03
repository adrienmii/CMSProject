<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo DIRNAME; ?>public/css/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,400,500,700|Ubuntu:300,400,500" rel="stylesheet">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>	
	<div id="sideBar" class="hidden-xs visible-sm">
		<header>
			<img src="<?php echo DIRNAME; ?>public/img/petitLogo.svg">
		</header>
		<main class="text-center">
			<div id="userPicture"></div>
			<div id="userName">VARVEROPOULOS<br>Valentin</div>
		</main>
		<nav id="navBar">
			<ul>
				<li class="active">Dashboard</li>
				<li>Enseignants</li>
				<li>Elèves</li>
				<li>Classes</li>
				<li>Emploi du temps</li>
				<li>Paramètres</li>
			</ul>			
		</nav>
	</div>
	<div id="pageContent">
		<header>
			<div id="topBar" class="col-md-12 hidden-xs visible-sm">
				<div class="row">
					<div class="col-md-6">
						<a id="toggleIcon" onclick="toggleNav()" href="#"></a>
					</div>
					<div class="col-md-2 col-md-offset-4">
						<input  id="inputSearch" type="text">
					</div>
				</div>											
			</div>
			<div id="topBarMobile" class="hidden-sm">
				<div class="row">
					<div class="col-xs-2">
						<a id="toggleIcon" onclick="toggleMenuMobile()" href="#"></a>
					</div>
					<div id="logoMobile" class="col-xs-6 col-xs-offset-1"></div>
					<div id="iconSearch" class="col-xs-2 col-xs-offset-1" onclick="toggleSearchMobile()""></div>					
				</div>	
				<nav id="navBarMobile" class="menuMobileClose">
					<ul>
						<li>Dashboard</li>
						<li>Enseignants</li>
						<li>Elèves</li>
						<li>Classes</li>
						<li>Emploi du temps</li>
						<li>Paramètres</li>
					</ul>	
				</nav>
				<div id="divInputSearchMobile" class="row divInputSearchMobileClose">
					<div class="col-xs-12">
						<input id="SearchMobile" type="text">
					</div>					
				</div>	
			</div>			
			<div id="pathSection" class="col-md-12">
				<p>Dashboard</p>
			</div>			
		</header>
		<main>		
			<div class="col-md-12">
			</div>							
		</main>	
	</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script>
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
	</script>

</body>
</html>
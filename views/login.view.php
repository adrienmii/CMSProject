<!-- Requis pour les notifs -->
<div id="notifications"></div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo DIRNAME; ?>public/js/global.js"></script>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo DIRNAME; ?>public/css/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,400,500,700|Ubuntu:300,400,500" rel="stylesheet">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body id="loginBody">
	<main>		
		<section id="loginForm">
			<header>				
			</header>
			<main>
				<?php $this->addModal("login", $config, $errors); ?>	
			</main>			
			<footer>
				<div class="row">
					<div id="help" class="col-xs-6 col-xs-offset-3">	
						<a href="#">Problème de connexion</a>
					</div>
				</div>				
			</footer>
		</section>
	</main>		
	
	<!-- Requis pour les notifs -->
	<?php if (!empty($_SESSION['ntf'])) {
		echo $_SESSION['ntf'];
		$_SESSION['ntf'] = null;
	}
	?>

</body>
</html>
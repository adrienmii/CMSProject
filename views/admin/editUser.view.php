
<main id="subscribeContainer">
	<section class="col-md-12">
		<header class="text-center">
			Modifier le profil de <?php echo $config['prefill']['firstname']." ".$config['prefill']['lastname']; ?>
		</header>
		<main>
			<?php $this->addModal("edituser", $config, $errors); ?>			
		</main>
	</section>
</main>



<main id="subscribeContainer">
	<section class="col-md-12">
		<header class="text-center">
			Ajouter un cours
		</header>
		<main>

			<?php $this->addModal("addCourse", $config, $errors); ?>
		</main>
	</section>
</main>

<script type="text/javascript">
	CKEDITOR.replace( 'textareaContent', {
		language: 'fr',
		height: '400px'
	});
</script>

<?php if(!empty($errors)) {
	echo implode("<br>", $errors);
} ?>
<form method="<?php echo $config['config']['method']; ?>" action="<?php echo $config['config']['action']; ?>">

	<?php foreach ($config['input'] as $name => $params): ?>
		<?php if ($params['type'] == "text" || $params['type'] == "password"): ?>

			<div class="row">
				<div class="col-xs-8 col-xs-offset-2">
					<input type="<?php echo $params['type']; ?>" name="<?php echo $name; ?>" placeholder="<?php echo $params['placeholder']; ?>" id="<?php echo $params['id']; ?>" <?php echo (isset($params['required']))?'required="required"':''; ?>>
				</div>
			</div>

		<?php endif; ?>
	<?php endforeach; ?>

	<div class="row">
		<div class="col-xs-12">	
			<input type="submit" value="<?php echo $config['submit']; ?>" name="submit_signin">
		</div>
	</div>

</form>


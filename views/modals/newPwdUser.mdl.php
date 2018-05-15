
<form method="<?php echo $config['config']['method']; ?>" action="<?php echo $config['config']['action']; ?>">
<div class="row">
	<?php foreach ($config['input'] as $name => $params): ?>
		<?php if ($params['type'] == "text" || $params['type'] == "password"){ ?>

			
				<div class="col-sm-12">
					<input type="<?php echo $params['type']; ?>" name="<?php echo $name; ?>" placeholder="<?php echo $params['placeholder']; ?>" id="<?php echo $params['id']; ?>" <?php echo (isset($params['required']))?'required="required"':''; ?>>
				</div>			
							
		<?php } ?>
	<?php endforeach; ?>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-3 col-sm-offset-9">	
		<input type="submit" class="addProfile" value="<?php echo $config['submit']; ?>" name="submit_signin">
	</div>
</div>	
</form>

<form method="<?php echo $config['config']['method']; ?>" action="<?php echo $config['config']['action']; ?>">

	<?php foreach ($config['input'] as $name => $params): ?>
		<?php if ($params['type'] == "text" || $params['type'] == "password"){ ?>

			<div class="row">
							<div class="col-xs-12 col-sm-2 text-left rowTitle">
							<?php echo $params['label']; ?>
							</div>
							<div class="col-xs-12 col-sm-4 rowValue">
								<input type="<?php echo $params['type']; ?>" <?php echo (!empty($config['prefill']) && !empty($config['prefill'][$name]))?"value='".strtoupper($config['prefill'][$name])."'":""; ?> name="<?php echo $name; ?>" placeholder="<?php echo $params['example']; ?>" id="<?php echo $params['id']; ?>" <?php echo (isset($params['required']))?'required="required"':''; ?>>
							</div>
							<div class="col-xs-12 col-sm-6 rowDesc">
								<?php echo $params['desc']; ?>
							</div>
						</div>


		<?php } ?>
	<?php endforeach; ?>
<br>
	<div class="row">
		<div class="col-xs-12">	
			<input type="submit" value="<?php echo $config['submit']; ?>" name="submit_signin">
		</div>
	</div>

</form>


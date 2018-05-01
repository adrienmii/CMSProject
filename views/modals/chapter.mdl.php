<form method="<?php echo $config['config']['method']; ?>" action="<?php echo $config['config']['action']; ?>">

	<?php foreach ($config['input'] as $name => $params): ?>
		<?php if ($params['type'] == "text" || $params['type'] == "password"){ ?>

			<div class="row">
				<div class="col-xs-12">
					<input type="<?php echo $params['type']; ?>" <?php echo (!empty($config['prefill']) && !empty($config['prefill'][$name]))?"value='".ucfirst($config['prefill'][$name])."'":""; ?> name="<?php echo $name; ?>" placeholder="<?php echo $params['placeholder']; ?>" id="<?php echo $params['id']; ?>" <?php echo (isset($params['required']))?'required="required"':''; ?>>
				</div>
			</div>

			<?php }elseif ($params['type'] == "select"){ ?>
			<div class="row">
				<div class="col-xs-12">
					<select name="<?php echo $name; ?>" id="<?php echo $params['id']; ?>" <?php echo ($params['multiple'])?" style='height:100px' multiple":""; ?>>
						<?php foreach ($params['options'] as $value): ?>
							<option value="<?php echo $value['id']; ?>" <?php if (!empty($config['prefill'][$name]) && $config['prefill'][$name] == $value['id']) { echo 'selected'; }?>> <?php echo $value['classname']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>


		<?php } ?>
	<?php endforeach; ?>

	<div class="row">
		<div class="col-xs-12">	
			<input type="submit" value="<?php echo $config['submit']; ?>" name="submit_signin">
		</div>
	</div>

</form>


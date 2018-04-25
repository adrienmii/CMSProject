<?php if(!empty($errors)) {
	echo implode("<br>", $errors);
} ?>
<form method="<?php echo $config['form']['config']['method']; ?>" action="<?php echo $config['form']['config']['action']; ?>">

	<?php foreach ($config['form']['input'] as $name => $params): ?>
		<?php if ($params['type'] == "text" || $params['type'] == "password"){ ?>

			<div class="row">
				<div class="col-xs-12">
					<input type="<?php echo $params['type']; ?>" value="<?php echo ($name != "pwd" ? $config['prefill'][$name] : ""); ?>" name="<?php echo $name; ?>" placeholder="<?php echo $params['placeholder']; ?>" id="<?php echo $params['id']; ?>" <?php echo (isset($params['required']))?'required="required"':''; ?>>
				</div>
			</div>

		<?php }elseif ($params['type'] == "select"){ ?>
			<div class="row">
				<div class="col-xs-12">
					<select name="<?php echo $name; ?>" id="<?php echo $params['id']; ?>">
						<?php foreach ($params['options'] as $value => $text): ?>
							<option <?php echo ($config['prefill'][$name] == $value ? "selected=\"selected\"" : ""); ?> value="<?php echo $value; ?>"><?php echo $text; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

		<?php } ?>
	<?php endforeach; ?>

	<div class="row">
		<div class="col-xs-12">	
			<input type="submit" value="<?php echo $config['form']['submit']; ?>" name="submit_signin">
		</div>
	</div>

</form>


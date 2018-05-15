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
                    <select name="<?php echo $name; ?>" id="<?php echo $params['id']; ?>" >
                        <option <?php echo (!empty($config['prefill']) && !empty($config['prefill'][$name]) ? "" : 'selected="true"'); ?> disabled>Choisir un chapitre</option>
                        <?php if(empty($params['options'])){ ?>
                            <option disabled>Vous devez créer un chapitre avant d'écrire un cours</option>
                        <?php }else{ ?>
                        <?php foreach ($params['options'] as $value): ?>
                            <option value="<?php echo $value['id']; ?>" <?php if (!empty($config['prefill'][$name]) && $config['prefill'][$name] == $value['id']) { echo 'selected'; }?>> <?php echo $value['label']; ?></option>
                        <?php endforeach; }?>
                    </select>
                </div>
            </div>


        <?php } ?>
    <?php endforeach; ?>

    <?php foreach ($config['textarea'] as $name => $params): ?>
        <div class="row">
            <div class="col-xs-12">
                <textarea name="<?php echo $name; ?>" id="<?php echo $params['id']; ?>" <?php echo (isset($params['required']))?'required="required"':''; ?>>
                    <?php echo (!empty($config['prefill']) && !empty($config['prefill'][$name]))? ucfirst($config['prefill'][$name]) : ""; ?>
                </textarea>
            </div>
        </div>
    <?php endforeach; ?>
    <br>
    <div class="row">
        <div class="col-xs-12">
            <input type="submit" value="<?php echo $config['submit']; ?>" name="submit_addCourse">
        </div>
    </div>

</form>
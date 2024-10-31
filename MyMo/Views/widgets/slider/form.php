<p>
	<?php echo __('Slider', 'mymo') ?>
    <select name="<?php echo $this->get_field_name('slider') ?>" class="w-100">
        <option value="">--- <?php echo __('Choose Slider', 'mymo') ?> ---</option>
        <?php
        foreach ($sliders as $item) :
        ?>
            <option value="<?php echo $item->id ?>" <?php if ($slider == $item->id) echo 'selected' ?>><?php echo $item->name ?></option>
        <?php
        endforeach;
        ?>
    </select>
</p>

<p><?php echo __('Speed', 'mymo') ?> <input type="number" class="speed w-100" name="<?php echo $this->get_field_name('speed') ?>" value="<?php echo $speed ?>" /></p>

<p>
    <?php echo __('Autoplay', 'mymo') ?>
    <select name="<?php echo $this->get_field_name('autoplay') ?>" class="w-100">
        <option value="1" <?php if ($autoplay == 1) echo 'selected' ?>><?php _e('Enabled', 'mymo') ?></option>
        <option value="0" <?php if ($autoplay == 0) echo 'selected' ?>><?php _e('Disabled', 'mymo') ?></option>
    </select>
</p>
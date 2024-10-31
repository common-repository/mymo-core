<div class="mymo-widget-popular-movies">
<p>
	<?php echo __('Title', 'mymo') ?>
    <input type="text" name="<?php echo $this->get_field_name('title') ?>" value="<?php echo $title ?>" class="w-100" />
</p>

<p>
    <?php echo __('Tab list', 'mymo') ?><br>
    <input type="checkbox" name="<?php echo $this->get_field_name('tablist') ?>[]" value="day" <?php if (in_array('day', $tablist)) echo 'checked' ?>> <?php echo __('Day', 'mymo') ?>
    <br>
    <input type="checkbox" name="<?php echo $this->get_field_name('tablist') ?>[]" value="week" <?php if (in_array('week', $tablist)) echo 'checked' ?>> <?php echo __('Week', 'mymo') ?>
    <br>
    <input type="checkbox" name="<?php echo $this->get_field_name('tablist') ?>[]" value="month" <?php if (in_array('month', $tablist)) echo 'checked' ?>> <?php echo __('Month', 'mymo') ?>
    <br>
    <input type="checkbox" name="<?php echo $this->get_field_name('tablist') ?>[]" value="all" <?php if (in_array('all', $tablist)) echo 'checked' ?>> <?php echo __('All', 'mymo') ?>
</p>

<p><?php echo __('Post number', 'mymo') ?> <input type="number" name="<?php echo $this->get_field_name('post_number') ?>" value="<?php echo $post_number ?>" class="w-100" /></p>
</div>
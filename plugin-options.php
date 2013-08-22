<?php 
function anim8_options_do_page() {    ?>
<div class="wrap">
	<?php if (false !== $_REQUEST['settings-updated']) : ?>
	<div class="updated fade"><p><strong><?php _e('Options saved', 'anim8theme'); ?></strong></p></div>
<?php endif; ?> 
<form method="post" action="options.php">
	<?php settings_fields('anim8_options'); ?>
	<?php $options = get_option('anim8_theme_options'); ?>
	<h3>Homepage Content Area 1</h3>
	<h4>Content Title</h4>
	<input type="text" size="36" name="anim8_theme_options[p1title]" value="<?php esc_attr_e($options['p1title']); ?>" />                 
	<h4>Content Text:</h4>
	<textarea id="anim8_theme_options[p1text]" class="large-text" style="height:130px; width:375px;" name="anim8_theme_options[p1text]"><?php echo esc_textarea($options['p1text']); ?></textarea>
	<p class="submit">
		<input type="submit" class="button-primary" value="<?php _e('Save Options', 'anim8theme'); ?>" />
	</p>

</form>
</div>
<?php
}

function anim8_options_validate($input) {
	global $select_options, $radio_options;
    // Our checkbox value is either 0 or 1
	if (!isset($input['option1']))
		$input['option1'] = null;
	$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );
    // Say our text option must be safe text with no HTML tags
	$input['sometext'] = wp_filter_nohtml_kses($input['sometext']);
    // Our select option must actually be in our array of select options
    // Say our textarea option must be safe text with the allowed tags for posts
	$input['sometextarea'] = wp_filter_post_kses($input['sometextarea']);
	return $input;
}

?>
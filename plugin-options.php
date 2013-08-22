<?php 
function anim8_options_do_page() {    ?>
<div class="wrap">
	<?php if (false !== $_REQUEST['settings-updated']) : ?>
		<div class="updated fade"><p><strong><?php _e('Options saved', 'anim8theme'); ?></strong></p></div>
	<?php endif; ?> 
	<form method="post" action="options.php">
		<?php settings_fields('anim8_options'); ?>
		<?php $options = get_option('anim8_theme_options'); ?>
		<a href="http://businessonmarketst.com"><img src="<?php echo plugins_url('/anim8/Images/logo.png'); ?>"></a>
		<p>We believe that every activity ties together and revolves around the five basic disciplines of business: planning and research, branding, web development, marketing, and business development. Once these elements are working in concert, we find that organic solutions rise easily to the surface. </p>
		<h4>Slider Width</h4>
		<input type="text" size="2" name="anim8_theme_options[width]" value="<?php esc_attr_e($options['width']); ?>" />
		<h4>Slider Height</h4>
		<input type="text" size="2" name="anim8_theme_options[height]" value="<?php esc_attr_e($options['height']); ?>" />
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Options', 'anim8theme'); ?>" />
		</p>
		<img style="width:90px;" src="<?php echo plugins_url('/anim8/Images/nick.jpeg'); ?>">
		<p>Developed By: Nicholas Koskowski, <a href="https://github.com/nickkos101/">check me out on github</a></p>
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
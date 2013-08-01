/**
 * Update color picker element
 * Used for static & dynamic added elements (when clone)
 */
function anim8_update_color_picker()
{
	var $ = jQuery;
	$( '.anim8-color-picker' ).each( function()
	{
		var $this = $( this ),
			$input = $this.siblings( 'input.anim8-color' );

		// Make sure the value is displayed
		if ( ! $input.val() )
			$input.val( '#' );

		$this.farbtastic( $input );
	} );
}

jQuery( document ).ready( function($)
{
	$( '.anim8-input' ).delegate( '.anim8-color', 'focus', function()
	{
		$( this ).siblings( '.anim8-color-picker' ).show();
		return false;
	} ).delegate( '.anim8-color', 'blur', function()
	{
		$( this ).siblings( '.anim8-color-picker' ).hide();
		return false;
	} );

	anim8_update_color_picker();
} );
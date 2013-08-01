/**
 * Update date picker element
 * Used for static & dynamic added elements (when clone)
 */
function anim8_update_date_picker()
{
	var $ = jQuery;

	$( '.anim8-date' ).each( function()
	{
		var $this = $( this ),
			options = $this.data( 'options' );

		$this.removeClass( 'hasDatepicker' ).attr( 'id', '' ).datepicker( options );
	} );
}

jQuery( document ).ready( function($)
{
	anim8_update_date_picker();
} );
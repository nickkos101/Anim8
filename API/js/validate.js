jQuery( document ).ready( function ( $ )
{
	var $form = $( '#post' );

	// Required field styling
	$.each( anim8.validationOptions.rules, function( k, v )
	{
		if ( v['required'] )
			$( '#' + k ).parent().siblings( '.anim8-label' ).addClass( 'required' ).append( '<span>*</span>' );
	} );

	anim8.validationOptions.invalidHandler = function( form, validator )
	{
		// Re-enable the submit ( publish/update ) button and hide the ajax indicator
		$( '#publish' ).removeClass( 'button-primary-disabled' );
		$( '#ajax-loading' ).attr( 'style','' );
		$form.siblings( '#message' ).remove();
		$form.before( '<div id="message" class="error"><p>' + anim8.summaryMessage  + '</p></div>' );
	};

	$form.validate( anim8.validationOptions );
} );
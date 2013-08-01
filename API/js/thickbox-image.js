jQuery( document ).ready( function( $ )
{
	$( '.anim8-thickbox-upload' ).click( function()
	{
		var $this = $( this ),
			$holder = $this.siblings( '.anim8-images' ),
			post_id = $( '#post_ID' ).val(),
			field_id = $this.attr( 'rel' ),
			backup = window.send_to_editor;

		window.send_to_editor = function( html ) {
			var $img = $( '<div />' ).append( html ).find( 'img' ),
				url = $img.attr( 'src' ),
				img_class = $img.attr( 'class' ),
				id = parseInt( img_class.replace( /\D/g, '' ), 10 );

			html = '<li id="item_' + id + '">';
			html += '<img src="' + url + '" />';
			html += '<div class="anim8-image-bar">';
			html += '<a class="anim8-delete-file" href="#" data-field_id="' + field_id + '" data-attachment_id="' + id + '">Delete</a>';
			html += '</div>';
			html += '<input type="hidden" name="' + field_id + '[]" value="' + id + '" />';
			html += '</li>';

			$holder.append( $( html ) ).removeClass( 'hidden' );

			tb_remove();
			window.send_to_editor = backup;
		}
		tb_show( '', 'media-upload.php?post_id=' + post_id + '&TB_iframe=true' );

		return false;
	} );
} );
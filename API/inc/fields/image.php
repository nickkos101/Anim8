<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'anim8_Image_Field' ) )
{
	class anim8_Image_Field extends anim8_File_Field
	{
		/**
		 * Enqueue scripts and styles
		 *
		 * @return void
		 */
		static function admin_enqueue_scripts()
		{
			// Enqueue same scripts and styles as for file field
			parent::admin_enqueue_scripts();

			wp_enqueue_style( 'anim8-image', API_CSS_URL . 'image.css', array(), API_VER );

			wp_enqueue_script( 'anim8-image', API_JS_URL . 'image.js', array( 'jquery-ui-sortable', 'wp-ajax-response' ), API_VER, true );
		}

		/**
		 * Add actions
		 *
		 * @return void
		 */
		static function add_actions()
		{
			// Do same actions as file field
			parent::add_actions();

			// Reorder images via Ajax
			add_action( 'wp_ajax_anim8_reorder_images', array( __CLASS__, 'wp_ajax_reorder_images' ) );
		}

		/**
		 * Ajax callback for reordering images
		 *
		 * @return void
		 */
		static function wp_ajax_reorder_images()
		{
			$field_id = isset( $_POST['field_id'] ) ? $_POST['field_id'] : 0;
			$order    = isset( $_POST['order'] ) ? $_POST['order'] : 0;

			check_admin_referer( "anim8-reorder-images_{$field_id}" );

			parse_str( $order, $items );
			$items = $items['item'];
			$order = 1;

			foreach ( $items as $item )
			{
				wp_update_post(
					array(
						'ID'         => $item,
						'menu_order' => $order++,
					)
				);
			}

			anim8_Meta_Box::ajax_response( __( 'Order saved', 'anim8' ), 'success' );
		}

		/**
		 * Get field HTML
		 *
		 * @param string $html
		 * @param mixed  $meta
		 * @param array  $field
		 *
		 * @return string
		 */
		static function html( $html, $meta, $field )
		{
			$i18n_title = _x( 'Upload images', 'image upload', 'anim8' );
			$i18n_more  = _x( '+ Add new image', 'image upload', 'anim8' );

			$html  = wp_nonce_field( "anim8-delete-file_{$field['id']}", "nonce-delete-file_{$field['id']}", false, false );
			$html .= wp_nonce_field( "anim8-reorder-images_{$field['id']}", "nonce-reorder-images_{$field['id']}", false, false );
			$html .= "<input type='hidden' class='field-id' value='{$field['id']}' />";

			// Uploaded images
			if ( ! empty( $meta ) )
				$html .= self::get_uploaded_images( $meta, $field );

			// Show form upload
			$html .= sprintf(
				'<h4>%s</h4>
				<div class="new-files">
					<div class="file-input"><input type="file" name="%s[]" /></div>
					<a class="anim8-add-file" href="#"><strong>%s</strong></a>
				</div>',
				$i18n_title,
				$field['id'],
				$i18n_more
			);

			return $html;
		}

		/**
		 * Get HTML markup for uploaded images
		 *
		 * @param array $images
		 * @param array $field
		 *
		 * @return string
		 */
		static function get_uploaded_images( $images, $field )
		{
			$html = '<ul class="anim8-images anim8-uploaded">';

			foreach ( $images as $image )
			{
				$html .= self::img_html( $image, $field['id'] );
			}

			$html .= '</ul>';

			return $html;
		}

		/**
		 * Get HTML markup for ONE uploaded image
		 *
		 * @param int $image Image ID
		 * @param int $field_id Field ID, used to delete action
		 *
		 * @return string
		 */
		static function img_html( $image, $field_id )
		{
			$i18n_delete = _x( 'Delete', 'image upload', 'anim8' );
			$i18n_edit   = _x( 'Edit', 'image upload', 'anim8' );
			$li = '
				<li id="item_%s">
					<img src="%s" />
					<div class="anim8-image-bar">
						<a title="%s" class="anim8-edit-file" href="%s" target="_blank">%s</a> |
						<a title="%s" class="anim8-delete-file" href="#" data-field_id="%s" data-attachment_id="%s">%s</a>
					</div>
				</li>
			';

			$src  = wp_get_attachment_image_src( $image, 'thumbnail' );
			$src  = $src[0];
			$link = get_edit_post_link( $image );

			return sprintf(
				$li,
				$image,
				$src,
				$i18n_edit, $link, $i18n_edit,
				$i18n_delete, $field_id, $image, $i18n_delete
			);
		}

		/**
		 * Standard meta retrieval
		 *
		 * @param mixed $meta
		 * @param int   $post_id
		 * @param array $field
		 * @param bool  $saved
		 *
		 * @return mixed
		 */
		static function meta( $meta, $post_id, $saved, $field )
		{
			global $wpdb;

			$meta = anim8_Meta_Box::meta( $meta, $post_id, $saved, $field );

			if ( empty( $meta ) )
				return array();

			$meta = implode( ',' , $meta );

			// Re-arrange images with 'menu_order'
			$meta = $wpdb->get_col( "
				SELECT ID FROM {$wpdb->posts}
				WHERE post_type = 'attachment'
				AND ID in ({$meta})
				ORDER BY menu_order ASC
			" );

			return (array) $meta;
		}
	}
}
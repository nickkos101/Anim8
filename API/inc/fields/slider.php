<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'anim8_Slider_Field' ) )
{
	class anim8_Slider_Field
	{
		/**
		 * Enqueue scripts and styles
		 *
		 * @return void
		 */
		static function admin_enqueue_scripts()
		{
			$url = API_CSS_URL . 'jqueryui';
			wp_enqueue_style( 'jquery-ui-core', "{$url}/jquery.ui.core.css", array(), '1.8.17' );
			wp_enqueue_style( 'jquery-ui-theme', "{$url}/jquery.ui.theme.css", array(), '1.8.17' );

			wp_enqueue_script( 'anim8-slider', API_JS_URL . 'slider.js', array( 'jquery-ui-slider' ), API_VER, true );
		}

		/**
		 * Get div HTML
		 *
		 * @param string $html
		 * @param mixed  $meta
		 * @param array  $field
		 *
		 * @return string
		 */
		static function html( $html, $meta, $field )
		{
			return sprintf(
				'<div class="clearfix">
					<div class="anim8-slider" rel="%s" id="%s"></div>
					<input type="hidden" name="%s" value="%s" />
				</div>',
				$field['format'],
				$field['id'],
				$field['field_name'],
				$meta
			);
		}
	}
}
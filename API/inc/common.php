<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'anim8_Common' ) )
{
	/**
	 * Common functions for the plugin
	 * Independent from meta box/field classes
	 */
	class anim8_Common
	{
		/**
		 * Do actions when class is loaded
		 *
		 * @return void
		 */
		static function on_load()
		{
			self::load_textdomain();
		}

		/**
		 * Load plugin translation
		 *
		 * @return void
		 */
		static function load_textdomain()
		{
			// l18n translation files
			$locale = get_locale();
			$dir    = trailingslashit( API_DIR . 'lang' );
			$mofile = "{$dir}{$locale}.mo";

			// In themes/plugins/mu-plugins directory
			load_textdomain( 'anim8', $mofile );
		}
	}

	anim8_Common::on_load();
}
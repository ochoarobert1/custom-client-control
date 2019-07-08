<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://robertochoa.com.ve/
 * @since      1.0.0
 *
 * @package    Custom_Client_Control
 * @subpackage Custom_Client_Control/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Custom_Client_Control
 * @subpackage Custom_Client_Control/includes
 * @author     Robert Ochoa <ochoa.robert1@gmail.com>
 */
class Custom_Client_Control_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'custom-client-control',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}

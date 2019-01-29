<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/dev-nm/WP-StudioLink-Integration
 * @since      1.0.0
 *
 * @package    Studio_Link_Integration
 * @subpackage Studio_Link_Integration/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Studio_Link_Integration
 * @subpackage Studio_Link_Integration/includes
 * @author     Devin Vinson <devinvinson@gmail.com>
 */
class Studio_Link_Integration_i18n {

	/**
	 * The domain specified for this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $domain    The domain identifier for this plugin.
	 */
	private $domain;
	
	private $titan_domain;

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			$this->domain,
			false,
			dirname( plugin_basename( __DIR__ ) ) . '/languages/'
		);

	}
	
	/**
	 * Load the plugin text domain for the titan translation.
	 *
	 * @since    1.0.2
	 */
	public function load_titan_textdomain() {

		load_plugin_textdomain(
			$this->titan_domain,
			false,
			dirname( plugin_basename( __DIR__ ) ) . '/admin/titan-framework/languages/'
		);

	}

	/**
	 * Set the domain equal to that of the specified domain.
	 *
	 * @since    1.0.0
	 * @param    string    $domain    The domain that represents the locale of this plugin.
	 */
	public function set_domain( $domain ) {
		$this->domain = $domain;
	}
	
	/**
	 * Set the domain equal to that of the specified domain.
	 *
	 * @since    1.0.2
	 * @param    string    $domain    The domain that represents the locale of this plugin.
	 */
	public function set_titan_domain( $domain ) {
		$this->titan_domain = $domain;
	}

}

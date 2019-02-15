<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/dev-nm/WP-StudioLink-Integration
 * @since      1.0.0
 *
 * @package    Studio_Link_Integration
 * @subpackage Studio_Link_Integration/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Studio_Link_Integration
 * @subpackage Studio_Link_Integration/admin
 * @author     Devin Vinson <devinvinson@gmail.com>
 */
class Studio_Link_Integration_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->load_dependencies();

	}

	/**
	 * Load the required dependencies for the Admin facing functionality.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Studio_Link_Integration_Admin_Settings. Registers the admin settings and page.
	 *
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) .  'admin/class-studio-link-integration-settings.php';

	}
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * Getting the actual date and time of the last change of the CSS to generate a version number.
		 * This has the advantage, that a change in sourcecode is instantly visible on the website.
		 */
		$my_css_ver  = date("ymd-Gis", filemtime( plugin_dir_path( __FILE__ ) . 'css/studio-link-integration-admin.css' ));
		wp_enqueue_style( 'stli_admin_css', plugin_dir_url( __FILE__ ) . 'css/studio-link-integration-admin.css', array(), $my_css_ver);

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * Getting the actual date and time of the last change of the CSS to generate a version number.
		 * This has the advantage, that a change in sourcecode is instantly visible on the website.
		 */
		$my_js_ver  = date("ymd-Gis", filemtime( plugin_dir_path( __FILE__ ) . 'js/studio-link-integration-admin.js' ));
		wp_enqueue_script( 'stl_admin_js', plugin_dir_url( __FILE__ ) . 'js/studio-link-integration-admin.js', array( 'jquery' ), $my_js_ver);

	}

}

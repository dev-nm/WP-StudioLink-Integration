<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/dev-nm/WP-StudioLink-Integration
 * @since      1.0.0
 *
 * @package    Studio_Link_Integration
 * @subpackage Studio_Link_Integration/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Studio_Link_Integration
 * @subpackage Studio_Link_Integration/public
 * @author     Devin Vinson <devinvinson@gmail.com>
 */
class Studio_Link_Integration_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
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
	 * - Studiolink_Integration_Settings. Registers the admin settings and page.
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
		require_once plugin_dir_path( dirname( __FILE__ ) ) .  'public/shortcodes/STLI_StudioLink.php';
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Studio_Link_Integration_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Studio_Link_Integration_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/studio-link-integration-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Studio_Link_Integration_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Studio_Link_Integration_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/studio-link-integration-public.js', array( 'jquery' ), $this->version, false );

	}
	
	/**
	 * Register the shortcodes.
	 *
	 * @since    1.0.0
	 */
	public function register_shortcodes() {
		add_shortcode( 'StudioLink', array( $this, 'studioLink_Integration_Shortcode') );
	}
	
	/**
	 * Initialize the StudioLink shortcode.
	 *
	 * @since    1.0.0
	 */
	function studioLink_Integration_Shortcode( $atts, $content ) {
		//Prüfe ob Shortcodes Aktiviert sind
		$titan = TitanFramework::getInstance( 'stli' );
		if($titan->getOption( 'shortcodes_enabled' )){
			// Speichere Übergabewerte
			$_atts = shortcode_atts( array(
				'online' => NULL,
				'status' => NULL,
				'slug' => NULL
			), $atts );
			
			// Args werden in besser verarbeitbare Variablen umgeschrieben
			$online = $_atts['online'];
			$status = $_atts['status'];
			$slug = $_atts['slug'];
			
			// Leere Übergabewerte werden gefüllt
			if(empty($online)){
				if(empty($status)){
					$online = 'true';
				} else {
					if($status == 'test' || $status == 'break' || $status == 'offline') {
						$online = 'false';
					} else {
						$online = 'true';
					}
				}
			}
			
			// Args sollen alle kleingeschrieben sein
			$online = strtolower($online);
			if(!empty($status))
				$status = strtolower($status);
			
			// Erzeuge StudioLink Objekt
			$StudioLink = new STLI_StudioLink($_atts['slug']);
			// Abbruch wenn kein Inhalt zwischen Shortcode
			if ( ! is_null( $content ) ) {
				// Onlinestatus bei nicht angabe eines Status wird geprüft
				if($StudioLink->online == $online && empty($status)) { 
					return $content;
				}
				// Onlinestatus bei angabe eines Status wird geprüft
				if($StudioLink->online != $online || $StudioLink->state != $status) {
					return '';
				} else {
					return $content;
				}
			} else {
				return '';
			}
		}
	}
	


}

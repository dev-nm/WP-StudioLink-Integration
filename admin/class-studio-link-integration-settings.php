<?php

/**
 * The settings of the plugin.
 *
 * @link       https://github.com/dev-nm/WP-StudioLink-Integration
 * @since      1.0.0
 *
 * @package    Studio_Link_Integration
 * @subpackage Studio_Link_Integration/admin
 */

/**
 * Class WordPress_Plugin_Template_Settings
 *
 */
class STLI_Admin_Settings {

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
	 * The LOF Object for creating the Options.
	 *
	 * @since    1.0.2
	 * @access   private
	 * @var      Object    $options    Object storing the Lightweight Options Framework.
	 */
	private $options;

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
		
		$this->options = new Lightweight_Options_Framework();

	}
	
	private function load_dependencies() {
		
		require_once plugin_dir_path( dirname( __FILE__ ) ) .  'admin/lightweight-options-framework/lof.php';
		
	}
	
	public function load_loaf_dependencies(){
		$this->options->load_dependencies();
	}
	
	public function stli_create_settings() {
		echo('<script>console.log("ICON: ' . plugins_url('img/menu_icon.png', __FILE__) . '");</script>');
		$menus = array(
			array(
				'type' => 'menu',
				'menu_title' => __( 'Studio Link', 'studio-link-integration' ),
				'submenu_title' => __('General', 'studio-link-integration' ),
				'page_title' => __('General Settings', 'studio-link-integration' ),
				'capability' => 'manage_options',
				'slug' => 'stli_general_settings',
				'icon' => plugins_url('img/menu_icon.png', __FILE__),
				'position' => 100,
			),
			array(
				'type' => 'submenu',
				'parent_slug' => 'stli_general_settings',
				'page_title' => __( 'Social Media Settings', 'studio-link-integration' ),
				'menu_title' => __( 'Social Media', 'studio-link-integration' ),
				'capability' => 'manage_options',
				'slug' => 'stli_social_general_settings',
				'callback' => array($this, 'stli_social_settings_content'),
			),
			array(
				'type' => 'submenu',
				'parent_slug' => 'stli_general_settings',
				'page_title' => __('Help', 'studio-link-integration' ),
				'menu_title' => __('Help', 'studio-link-integration' ),
				'capability' => 'manage_options',
				'slug' => 'stli_help_settings',
				'callback' => array($this, 'stli_help_content' ),
			),
		);
		
		$sections = array(
			array(
				'id' => 'stli_general_section',
				'title' => '',
				'callback' => array( $this, 'general_section_content' ),
				'page' => 'stli_general_settings',
				'option_get' => 'stli_general',
			),
			array(
				'id' => 'stli_social_general_section',
				'title' => '',
				'callback' => array( $this, 'stli_social_general_content' ),
				'page' => 'stli_social_api_settings',
				'option_get' => 'stli_social_api',
			),
			array(
				'id' => 'stli_social_twitter_offline_section',
				'title' => __('Offline Post', 'studio-link-integration' ),
				'callback' => array(),
				'page' => 'stli_social_twitter_settings',
				'option_get' => 'stli_social_twitter',
			),
			array(
				'id' => 'stli_social_twitter_online_section',
				'title' => __('Online Post', 'studio-link-integration' ),
				'callback' => array(),
				'page' => 'stli_social_twitter_settings',
				'option_get' => 'stli_social_twitter',
			),
			array(
				'id' => 'stli_social_twitter_preshow_section',
				'title' => __('Preshow', 'studio-link-integration' ),
				'callback' => array(),
				'page' => 'stli_social_twitter_settings',
				'option_get' => 'stli_social_twitter',
			),
			array(
				'id' => 'stli_social_twitter_live_section',
				'title' => __('Live', 'studio-link-integration' ),
				'callback' => array(),
				'page' => 'stli_social_twitter_settings',
				'option_get' => 'stli_social_twitter',
			),
			array(
				'id' => 'stli_social_twitter_postshow_section',
				'title' => __('Postshow', 'studio-link-integration' ),
				'callback' => array(),
				'page' => 'stli_social_twitter_settings',
				'option_get' => 'stli_social_twitter',
			),
			array(
				'id' => 'stli_social_twitter_break_section',
				'title' => __('Break', 'studio-link-integration' ),
				'callback' => array(),
				'page' => 'stli_social_twitter_settings',
				'option_get' => 'stli_social_twitter',
			),
			
			array(
				'id' => 'help_section',
				'callback' => array(),
				'page' => 'stli_help_settings',
				'option_get' => 'stli_help',
			),
			
		);
		
		$fields = array(
			array(
				'label' => __( 'Studio Link Slug', 'studio-link-integration' ),
				'id' => 'stli_slug',
				'type' => 'text',
				'section' => 'stli_general_section',
				'desc' => __( 'The Studio Link Slug, you can set in the Studio Link On Air Options.', 'studio-link-integration' ),
				'default' => '',
			),
			array(
				'label' => __( 'Enable Shortcodes', 'studio-link-integration' ),
				'id' => 'stli_enable_shortcodes',
				'type' => 'switch',
				'section' => 'stli_general_section',
				'desc' => __( 'Turns the ShortCodes on or off.', 'studio-link-integration' ),
				'default' => '1',
			),
			array(
				'label' => __('Status Caching', 'studio-link-integration' ),
				'id' => 'stli_status_caching',
				'type' => 'number',
				'section' => 'stli_general_section',
				'desc' => __('This sets the time after wich the Status is rechecked. Set 0 to disable Caching.', 'studio-link-integration' ),
				'default' => '60',
			),
			
			array(
				'label' => __('Twitter API Key', 'studio-link-integration' ),
				'id' => 'twitter_api_key',
				'type' => 'text',
				'section' => 'stli_social_general_section',
			),
			array(
				'label' => __('Twitter API Secret', 'studio-link-integration' ),
				'id' => 'twitter_api_secret',
				'type' => 'text',
				'section' => 'stli_social_general_section',
				'default' => '',
			),
			array(
				'label' => __('Twitter Token', 'studio-link-integration' ),
				'id' => 'twitter_token',
				'type' => 'text',
				'section' => 'stli_social_general_section',
			),
			array(
				'label' => __('Twitter Token Secret', 'studio-link-integration' ),
				'id' => 'twitter_token_secret',
				'type' => 'text',
				'section' => 'stli_social_general_section',
			),
			
			array(
				'label' => __('Enable Offline Post', 'studio-link-integration' ),
				'id' => 'twitter_enable_offline',
				'type' => 'switch',
				'section' => 'stli_social_twitter_offline_section',
				'default' => '',
				'desc' => __( 'This lets you post something if the Podcast goes Offline.', 'studio-link-integration' ),
			),
			array(
				'label' => __('Offline Text', 'studio-link-integration' ),
				'id' => 'twitter_text_offline',
				'type' => 'twitterpost',
				'section' => 'stli_social_twitter_offline_section',
				'default' => __('My podcast $podcast_name is now offline! See you again next time!', 'studio-link-integration' ),
			),
			array(
				'label' => __('Enable Online Post', 'studio-link-integration' ),
				'id' => 'twitter_enable_online',
				'type' => 'switch',
				'section' => 'stli_social_twitter_online_section',
				'default' => '',
				'desc' => __( 'This lets you post something if the Podcast goes Online.', 'studio-link-integration' ),
			),
			array(
				'label' => __('Online Text', 'studio-link-integration' ),
				'id' => 'twitter_text_online',
				'type' => 'twitterpost',
				'section' => 'stli_social_twitter_online_section',
				'default' => __('We`re online now! Visit $url to join us!', 'studio-link-integration' ),
			),
			array(
				'label' => __('Enable Preshow Post', 'studio-link-integration' ),
				'id' => 'twitter_enable_preshow',
				'type' => 'switch',
				'section' => 'stli_social_twitter_preshow_section',
				'default' => '0',
				'desc' => __( 'This lets you post something if the Podcast goes into the Preshow state.', 'studio-link-integration' ),
			),
			array(
				'label' => __('Preshow Text', 'studio-link-integration' ),
				'id' => 'twitter_text_preshow',
				'type' => 'twitterpost',
				'section' => 'stli_social_twitter_preshow_section',
				'default' => __('We`re just preparing for $podcast_name . Join us at $url so you dont miss anything!', 'studio-link-integration' ),
			),
			array(
				'label' => __('Enable Live Post', 'studio-link-integration' ),
				'id' => 'twitter_enable_live',
				'type' => 'switch',
				'section' => 'stli_social_twitter_live_section',
				'default' => '',
				'desc' => __( 'This lets you post something if the Podcast goes Live.', 'studio-link-integration' ),
			),
			array(
				'label' => __('Live Text', 'studio-link-integration' ),
				'id' => 'twitter_text_live',
				'type' => 'twitterpost',
				'section' => 'stli_social_twitter_live_section',
				'default' => __('We`re online now! Visit $url to join us!', 'studio-link-integration' ),
			),
			array(
				'label' => __('Enable Postshow Post', 'studio-link-integration' ),
				'id' => 'twitter_enable_postshow',
				'type' => 'switch',
				'section' => 'stli_social_twitter_postshow_section',
				'default' => '',
				'desc' => __( 'This lets you post something if the Podcast goes into the Postshow state.', 'studio-link-integration' ),
			),
			array(
				'label' => __('Postshow Text', 'studio-link-integration' ),
				'id' => 'twitter_text_postshow',
				'type' => 'twitterpost',
				'section' => 'stli_social_twitter_postshow_section',
				'default' => __('Show is over, but we`re still here for you and your questions at $url!', 'studio-link-integration' ),
			),
			array(
				'label' => __('Enable Break Post', 'studio-link-integration' ),
				'id' => 'twitter_enable_break',
				'type' => 'switch',
				'section' => 'stli_social_twitter_break_section',
				'default' => '',
				'desc' => __( 'This lets you post something if the Podcast has a Break.', 'studio-link-integration' ),
			),
			array(
				'label' => __('Break Text', 'studio-link-integration' ),
				'id' => 'twitter_text_break',
				'type' => 'twitterpost',
				'section' => 'stli_social_twitter_break_section',
				'default' => __('Just a little break at $podcast_name - We`re back in no time!', 'studio-link-integration' ),
			),
			
			array(
				'label' => __('General' ,'studio-link-integration' ),
				'id' => 'help_general',
				'type' => 'custom',
				'section' => 'help_section',
				'value' => __('This Plugin is made to integrate Studio Link into your Wordpress Installation.<br>Currenty the following features are supported:', 'studio-link-integration' ),
			),
			array(
				'label' => __('Shortcodes' ,'studio-link-integration' ),
				'id' => 'help_shortcodes',
				'type' => 'custom',
				'section' => 'help_section',
				'value' => __('Short Codes are making you able, to use custom code on your pages that is being only loaded if your Podcast ist in a certain state.<br>
As example:<br>
<br>
<strong>[StudioLink online="true"]</strong> This text is only shown if you`re Podcast is in the Preshow, Live or Postshow state.<strong>[/StudioLink]</strong><br>
<strong>[StudioLink]</strong> This has the exact same effect as online="true". <strong>[/StudioLink]</strong><br>
<strong>[StudioLink status="Preshow"]</strong> This Text is only shown, if your Podcast is in the "Preshow" state. <strong>[/StudioLink]</strong><br>
<br>
There are the following Options:<br>
Online: true / false<br>
Status: offline / preshow / live / postshow / break / online<br>
<br>
The Podcast that is being watched is detemined by the Studio Link Slug, you set in the <strong>General Options</strong>.<br>If you want to use another slug, you can set it in the Shortcode: <strong>[StudioLink slug="myteststream" online="true"]The Podcast with the slug "mysteststream" is online![/StudioLink]', 'studio-link-integration' ),
			),
		);
		
		$this->options->set_menus($menus);
		$this->options->set_sections($sections);
		$this->options->set_fields($fields);
		$this->options->default_settings();
		$this->options->create_menus();
		
	}
	
	public function stli_setup_settings() {
		$this->options->create_sections();
		$this->options->create_fields();
	}
	
	/*********************************
	* Custom Callbacks
	*/
	
	public function stli_social_general_content(){
	?>
		<table class="form-table">
			<tr>
				<td><?php printf(__( 'You need to have a connection to the Twitter API to make it possible to post automaticly onto Twitter:<br><ol><strong><li>Apply for a Developer Account at <a href="https://developer.twitter.com/">Twitter</a></li><li>Register this site as an application on <a href="https://developer.twitter.com/en/apps">Registration for Applications</a>.</li></strong><ul><li>Your App can not include "Twitter".</li><li>Your Applicationdescription can be anything</li><li>Check "Enable Sign in with Twitter".</li><li>The WebSite and Callback URL should be: <a href="%1$s">%2$s</a></ul><strong><li>Get the API and Access Tokens and Secrets and copy them into the Fields below.</li></strong></ol>', 'studio-link-integration' ), home_url(), home_url()); ?></td>
			</tr>
		</table>
	<?php
	}
	
	public function general_section_content(){
	?>
		<table class="form-table">
			<tr>
				<th>
					<?php _e( 'Slug Position:', 'studio-link-integration' ); ?>
				</th>
				<td>
				<?php printf('<img src="%s">',
						plugins_url('img/slug_position.jpg', __FILE__)
				); ?>
				</td>
			</tr>
		</table>
	<?php
	}
	
	public function stli_social_settings_content() { ?>
		<div class="wrap">
			<h1><?php _e('Social Media Settings', 'studio-link-integration' );?></h1>
			<div class="error">
			<?php 
				settings_errors(); 
				$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'api_section';
				printf(__( 'This Area is still under heavy construction! None of the Options will Work in the realeased Version %s!', 'studio-link-integration' ), $this->version);
			?>
			</div>
			
			
			<h2 class="nav-tab-wrapper">
				<!--<a href="?page=stli_social_general_settings&tab=general_section" class="nav-tab <?php echo $active_tab == 'general_section' ? 'nav-tab-active' : ''; ?>"><?php _e('General Options', 'studio-link-integration' ); ?></a>-->
				<a href="?page=stli_social_general_settings&tab=api_section" class="nav-tab <?php echo $active_tab == 'api_section' ? 'nav-tab-active' : ''; ?>"><?php _e('API Options', 'studio-link-integration' ); ?></a>
				<a href="?page=stli_social_general_settings&tab=twitter_section" class="nav-tab <?php echo $active_tab == 'twitter_section' ? 'nav-tab-active' : ''; ?>"><?php _e('Twitter Options', 'studio-link-integration' ); ?></a>
			</h2>
			
			<form method="POST" action="options.php">
				<?php
					if( $active_tab == 'general_section' ) {
						//settings_fields( 'stli_social_general_settings' );
						//do_settings_sections( 'stli_social_general_settings' );
						settings_fields( 'stli_social_api_settings' );
						do_settings_sections( 'stli_social_api_settings' );
					} else if( $active_tab == 'api_section' ){
						settings_fields( 'stli_social_api_settings' );
						do_settings_sections( 'stli_social_api_settings' );
					} else {
						settings_fields( 'stli_social_twitter_settings' );
						do_settings_sections( 'stli_social_twitter_settings' );
					}
					submit_button();
				?>
			</form>
		</div> <?php
	}
	
	public function stli_help_content(){
		?>
		<div class="wrap">
			<h1><?php echo( __('Help', 'studio-link-integration' ) ); ?></h1>
			<form>
				<?php
					settings_fields( 'stli_help_settings' );
					do_settings_sections( 'stli_help_settings' );
				?>
			</form>
		</div> 
		<?php
	}
}
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
	
	private function load_dependencies() {
		
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/titan-framework/titan-framework-embedder.php';
		
	}
	
	public function stli_create_options() {
		
		// Initialize the Titan Framework
		$titan = TitanFramework::getInstance( 'stli' );
		// Set Up the Panels, Subpanels and Tab strukture
		$panel_general = $titan->createAdminPanel( array(
			'name' => __( 'Studio Link', 'studio-link-integration' ),
			'icon' => plugins_url('img/menu_icon.png', __FILE__)
		) );
		$panel_social = $panel_general->createAdminPanel( array(
			'name' => __( 'Social Media', 'studio-link-integration' ),
			'desc' => __( 'This Area is still under heavy construction! None of the Options will Work in the realeased Version 1.0.1!', 'studio-link-integration' ),
		) );
		$tab_social_general = $panel_social->createTab( array(
			'name' => __( 'General', 'studio-link-integration' ),
		) );
		$tab_social_twitterapi = $panel_social->createTab( array(
			'name' => __( 'Twitter API', 'studio-link-integration' ),
			'desc' => __( 'You need to have a connection to the Twitter API to make it possible to post automaticly onto Twitter:<br><ol><strong><li>Apply for a Developer Account at <a href="https://developer.twitter.com/">Twitter</a></li><li>Register this site as an application on <a href="https://developer.twitter.com/en/apps">Registration for Applications</a>.</li></strong><ul><li>Your App can not include "Twitter".</li><li>Your Applicationdescription can be anything</li><li>Check "Enable Sign in with Twitter".</li><li>The WebSite and Callback URL should be:', 'studio-link-integration' ) . ' <a href="' . home_url()  . '">' . home_url() . '</a>' . __( '</ul><strong><li>Get the API and Access Tokens and Secrets and copy them into the Fields below.</li></strong></ol>', 'studio-link-integration' ),
		) );
		$tab_social_twitterpost = $panel_social->createTab( array(
			'name' => __( 'Twitter Posting', 'studio-link-integration' ),
			'desc' => __( 'Please Check if you have your Twitter API configured correctly before using this Menue!', 'studio-link-integration' ),
		) );
		
		
		// GENERAL ADMIN PANEL: set up Options
		
		$panel_general->createOption( array(
			'type' => 'custom',
			'name' => __( 'Slug Position:', 'studio-link-integration' ),
			'custom' => '<img src="' . plugins_url('img/slug_position.jpg', __FILE__) . '">',
		) );
		$panel_general->createOption( array(
			'name' => __( 'Studio Link Slug', 'studio-link-integration' ), 			// Name of the option which will be displayed in the admin panel.
			'id' => 'studiolink_slug', 												// The ID which will be used to get the value of this option.
			'type' => 'text', 														// Type of option we are creating.
			'desc' => __( 'The Studio Link Slug, you can set in the Studio Link On Air Options.', 'studio-link-integration' ) // Description of the option which will be displayed in the admin panel.
		) );
		
		$panel_general->createOption( array(
			'name' => __( 'Shortcodes', 'studio-link-integration' ), 			// Name of the option which will be displayed in the admin panel.
			'id' => 'shortcodes_enabled', 												// The ID which will be used to get the value of this option.
			'type' => 'enable',
			'default' => true,													// Type of option we are creating.
			'desc' => __( 'Turns the ShortCodes on or off.', 'studio-link-integration' ) // Description of the option which will be displayed in the admin panel.
		) );

		$panel_general->createOption( array(
			'type' => 'save'
		) );
		
		// SOCIAL GENERAL TAB: set up Options
		$tab_social_general->createOption( array(
			'name' => __( 'Enable Automatic Twitter Postings', 'studio-link-integration' ),
			'id' => 'twitterpost_enabled',
			'type' => 'enable',
			'default' => false,
			'desc' => __( 'This Enables the Automatic Twitter Posting. You can learn more about it in the "Twitter Posting" tab.', 'studio-link-integration' ),
		) );
			
		/*********************
		SAVE BUTTON IS MISSING (Cause Twitter Optins arent working right now)
		*********************/
		
		// SOCIAL TWITTER API TAB_ set up Options
		
		$tab_social_twitterapi->createOption( array(
			'name' => __( 'Twitter API Key', 'studio-link-integration' ),
			'id' => 'twitter_api_key',
			'type' => 'text'
		) );
		$tab_social_twitterapi->createOption( array(
			'name' => __( 'Twitter API Secret', 'studio-link-integration' ),
			'id' => 'twitter_api_secret',
			'type' => 'text'
		) );
		$tab_social_twitterapi->createOption( array(
			'name' => __( 'Twitter Token', 'studio-link-integration' ),
			'id' => 'twitter_token',
			'type' => 'text'
		) );
		$tab_social_twitterapi->createOption( array(
			'name' => __( 'Twitter Token Secret', 'studio-link-integration' ),
			'id' => 'twitter_token_secret',
			'type' => 'text'
		) );
		
		/*********************
		SAVE BUTTON IS MISSING (Cause Twitter Optins arent working right now)
		*********************/
		
		// SOCIAL TWITTERPOST TAB: set up Options
		
		$tab_social_twitterpost->createOption( array(
			'type' => 'custom',
			'custom' => '<h1>' . __( 'Offline', 'studio-link-integration' ) . '</h1>',
		) );
		$tab_social_twitterpost->createOption( array(
			'name' => __( 'Enable Offline Post', 'studio-link-integration' ),
			'id' => 'twitterpost_offline_enabled',
			'type' => 'enable',
			'default' => false,
			'desc' => __( 'This lets you post something if the Podcast goes Offline.', 'studio-link-integration' ),
		) );
		$tab_social_twitterpost->createOption( array(
			'name' => __( 'Offline Post Text', 'studio-link-integration' ),
			'id' => 'twitterpost_offline_text',
			'type' => 'textarea',
			'default' => __('My podcast $podcast_name is now offline! See you again next time!', 'studio-link-integration' ),
			'desc' => __( 'This is the Post that will get Tweeted.', 'studio-link-integration' )
		) );
		
		$tab_social_twitterpost->createOption( array(
			'type' => 'custom',
			'custom' => '<h1>' . __( 'Online', 'studio-link-integration' ) . '</h1>',		
		) );
		$tab_social_twitterpost->createOption( array(
			'name' => __( 'Enable Online Post', 'studio-link-integration' ),
			'id' => 'twitterpost_online_enabled',
			'type' => 'enable',
			'default' => false,
			'desc' => __( 'This lets you post something if the Podcast goes Online.', 'studio-link-integration' ),
		) );
		$tab_social_twitterpost->createOption( array(
			'name' => __( 'Online Post Text', 'studio-link-integration' ),
			'id' => 'twitterpost_online_text',
			'type' => 'textarea',
			'default' => __('We`re online now! Visit $url to join us!', 'studio-link-integration' ),
			'desc' => __( 'This is the Post that will get Tweeted.', 'studio-link-integration' )
		) );
		
		$tab_social_twitterpost->createOption( array(
			'type' => 'custom',
			'custom' => '<h1>' . __( 'Preshow', 'studio-link-integration' ) . '</h1>',
		) );
		$tab_social_twitterpost->createOption( array(
			'name' => __( 'Enable Preshow Post', 'studio-link-integration' ),
			'id' => 'twitterpost_preshow_enabled',
			'type' => 'enable',
			'default' => false,
			'desc' => __( 'This lets you post something if the Podcast goes into the Preshow state.', 'studio-link-integration' ),
		) );
		$tab_social_twitterpost->createOption( array(
			'name' => __( 'Preshow Post Text', 'studio-link-integration' ),
			'id' => 'twitterpost_preshow_text',
			'type' => 'textarea',
			'default' => __('We`re just preparing for $podcast_name . Join us at $url so you dont miss anything!', 'studio-link-integration' ),
			'desc' => __( 'This is the Post that will get Tweeted.', 'studio-link-integration' )
		) );
		
		$tab_social_twitterpost->createOption( array(
			'type' => 'custom',
			'custom' => '<h1>' . __( 'Live', 'studio-link-integration' ) . '</h1>',
		) );
		$tab_social_twitterpost->createOption( array(
			'name' => __( 'Enable Live Post', 'studio-link-integration' ),
			'id' => 'twitterpost_live_enabled',
			'type' => 'enable',
			'default' => false,
			'desc' => __( 'This lets you post something if the Podcast goes Live.', 'studio-link-integration' ),
		) );
		$tab_social_twitterpost->createOption( array(
			'name' => __( 'live Post Text', 'studio-link-integration' ),
			'id' => 'twitterpost_live_text',
			'type' => 'textarea',
			'default' => __('We`re online now! Visit $url to join us!', 'studio-link-integration' ),
			'desc' => __( 'This is the Post that will get Tweeted.', 'studio-link-integration' )
		) );
		
		$tab_social_twitterpost->createOption( array(
			'type' => 'custom',
			'custom' => '<h1>' . __( 'Postshow', 'studio-link-integration' ) . '</h1>',
		) );
		$tab_social_twitterpost->createOption( array(
			'name' => __( 'Enable Postshow Post', 'studio-link-integration' ),
			'id' => 'twitterpost_postshow_enabled',
			'type' => 'enable',
			'default' => false,
			'desc' => __( 'This lets you post something if the Podcast goes into the Postshow state.', 'studio-link-integration' ),
		) );
		$tab_social_twitterpost->createOption( array(
			'name' => __( 'Postshow Post Text', 'studio-link-integration' ),
			'id' => 'twitterpost_postshow_text',
			'type' => 'textarea',
			'default' => __('Show is over, but we`re still here for you and your questions at $url!', 'studio-link-integration' ),
			'desc' => __( 'This is the Post that will get Tweeted.', 'studio-link-integration' )
		) );
		
		$tab_social_twitterpost->createOption( array(
			'type' => 'custom',
			'custom' => '<h1>' . __( 'Break', 'studio-link-integration' ) . '</h1>',
		) );
		$tab_social_twitterpost->createOption( array(
			'name' => __( 'Enable Break Post', 'studio-link-integration' ),
			'id' => 'twitterpost_break_enabled',
			'type' => 'enable',
			'default' => false,
			'desc' => __( 'This lets you post something if the Podcast has a Break.', 'studio-link-integration' ),
		) );
		$tab_social_twitterpost->createOption( array(
			'name' => __( 'Break Post Text', 'studio-link-integration' ),
			'id' => 'twitterpost_break_text',
			'type' => 'textarea',
			'default' => __('Just a little break at $podcast_name - We`re back in no time!', 'studio-link-integration' ),
			'desc' => __( 'This is the Post that will get Tweeted.', 'studio-link-integration' )
		) );
		
		/*********************
		SAVE BUTTON IS MISSING (Cause Twitter Optins arent working right now)
		*********************/
	}
	
}
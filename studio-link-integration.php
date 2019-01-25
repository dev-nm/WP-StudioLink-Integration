<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/dev-nm/WP-StudioLink-Integration
 * @since             1.0.0
 * @package           Studio_Link_Integration
 *
 * @wordpress-plugin
 * Plugin Name:       Studio Link Integration
 * Plugin URI:        https://sendegate.de/t/wordpress-studio-link-integration/8416
 * Description:       This Plugin integrates Studio Link into your Wordpress installation.
 * Version:           1.0.1
 * Author:            Nicolas Mierbach
 * Author URI:        https://github.com/dev-nm/WP-StudioLink-Integration
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       studio-link-integration
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-studio-link-integration-activator.php
 */
function activate_stli_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-studio-link-integration-activator.php';
	Studio_Link_Integration_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-studio-link-integration-deactivator.php
 */
function deactivate_stli_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-studio-link-integration-deactivator.php';
	Studio_Link_Integration_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_stli_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_stli_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-studio-link-integration.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_stli_plugin() {

	$plugin = new Studio_Link_Integration();
	$plugin->run();

}
run_stli_plugin();

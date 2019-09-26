<?php
/**
 * Plugin Name:       Staff Asia Cross Sell Upsell Options
 * Plugin URI:        https://staffasia.org/CrossSeelUpsell
 * Description:       This is Cross Sell upsell Options form WPLMS 
 * Version:           1.00
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            YITH
 * Author URI:        mahbubwplaravel.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */


if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if ( ! function_exists( 'is_plugin_active' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

function yith_wacp_premium_install_woocommerce_admin_notice() {
	?>
	<div class="error">
		<p><?php _e('This plugin only work for with Woocommerce Extension');?></p>
	</div>
<?php
}


if ( ! function_exists( 'yit_deactive_free_version' ) ) {
	require_once 'plugin-fw/yit-deactive-plugin.php';
}
yit_deactive_free_version( 'YITH_WACP_FREE_INIT', plugin_basename( __FILE__ ) );





if ( ! function_exists( 'yith_plugin_registration_hook' ) ) {
	require_once 'plugin-fw/yit-plugin-registration-hook.php';
}
register_activation_hook( __FILE__, 'yith_plugin_registration_hook' );




if ( ! defined( 'YITH_WACP_VERSION' ) ){
	define( 'YITH_WACP_VERSION', '1.00' );
}

// if ( ! defined( 'YITH_WACP_PREMIUM' ) ) {
// 	define( 'YITH_WACP_PREMIUM', '1' );
// }

if ( ! defined( 'YITH_WACP' ) ) {
	define( 'YITH_WACP', true );
}

if ( ! defined( 'YITH_WACP_FILE' ) ) {
	define( 'YITH_WACP_FILE', __FILE__ );
}

if ( ! defined( 'YITH_WACP_URL' ) ) {
	define( 'YITH_WACP_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'YITH_WACP_DIR' ) ) {
	define( 'YITH_WACP_DIR', plugin_dir_path( __FILE__ )  );
}

if ( ! defined( 'YITH_WACP_TEMPLATE_PATH' ) ) {
	define( 'YITH_WACP_TEMPLATE_PATH', YITH_WACP_DIR . 'templates' );
}

if ( ! defined( 'YITH_WACP_ASSETS_URL' ) ) {
	define( 'YITH_WACP_ASSETS_URL', YITH_WACP_URL . 'assets' );
}

if ( ! defined( 'YITH_WACP_INIT' ) ) {
	define( 'YITH_WACP_INIT', plugin_basename( __FILE__ ) );
}

if ( ! defined( 'YITH_WACP_SLUG' ) ) {
	define( 'YITH_WACP_SLUG', 'yith-woocommerce-added-to-cart-popup' );
}

if ( ! defined( 'YITH_WACP_SECRET_KEY' ) ) {
	define( 'YITH_WACP_SECRET_KEY', 'T05qW0KkKsgW2B5PsTqS' );
}

/* Plugin Framework Version Check */
if( ! function_exists( 'yit_maybe_plugin_fw_loader' ) && file_exists( YITH_WACP_DIR . 'plugin-fw/init.php' ) ) {
	require_once( YITH_WACP_DIR . 'plugin-fw/init.php' );
}
yit_maybe_plugin_fw_loader( YITH_WACP_DIR  );

function yith_wacp_premium_init() {

	load_plugin_textdomain( 'yith-woocommerce-added-to-cart-popup', false, dirname( plugin_basename( __FILE__ ) ). '/languages/' );

	// Load required classes and functions
	require_once( 'includes/function.yith-wacp.php' );
	require_once( 'includes/class.yith-wacp.php' );

	// Let's start the game!
	YITH_WACP();
}
add_action( 'yith_wacp_premium_init', 'yith_wacp_premium_init' );


function yith_wacp_premium_install() {

	if ( ! function_exists( 'WC' ) ) {
		add_action( 'admin_notices', 'yith_wacp_premium_install_woocommerce_admin_notice' );
	}
	else {
		do_action( 'yith_wacp_premium_init' );
	}
}
add_action( 'plugins_loaded', 'yith_wacp_premium_install', 11 );
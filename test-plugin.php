<?php
	/**
	 *  Test Plugin
	 *
	 * @package    StorePress/TestPlugin
	 *
	 * @wordpress-plugin
	 * Plugin Name:       Test Plugin
	 * Plugin URI:        https://wordpress.com/plugin/
	 * Description:       A StorePress Plugin
	 * Version:           0.1.0
	 * Requires at least: 6.4
	 * Requires PHP:      7.4
	 * Author:            EmranAhmed
	 * Author URI:        https://storepress.com/
	 * Text Domain:       test-plugin
	 * License:           GPL v3 or later
	 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
	 * Domain Path:       /languages
	 */

	/**
	 * Bootstrap the plugin.
	 */

	defined( 'ABSPATH' ) || die( 'Keep Silent' );

	use StorePress\TestPlugin\Plugin;
	use Automattic\WooCommerce\Utilities\FeaturesUtil;

if ( ! defined( 'STOREPRESS_TEST_PLUGIN_PLUGIN_FILE' ) ) {
	define( 'STOREPRESS_TEST_PLUGIN_PLUGIN_FILE', __FILE__ );
}

	// Include the Plugin class.
if ( ! class_exists( '\StorePress\TestPlugin\Plugin' ) ) {
	require_once plugin_dir_path( __FILE__ ) . '/includes/Plugin.php';
}

	/**
	 * WooCommerce fallback notice.
	 *
	 * @since 0.1.0
	 */
function storepress_test_plugin_missing_wc_notice() {
	/* translators: %s WC download URL link. */
	echo '<div class="error"><p><strong>' . sprintf( esc_html__( 'Test Plugin requires WooCommerce to be installed and active. You can download %s here.', 'test-plugin' ), '<a href="https://woocommerce.com/" target="_blank">WooCommerce</a>' ) . '</strong></p></div>';
}

	/**
	 * The main function that returns the Plugin class
	 *
	 * @return Plugin
	 * @since 0.1.0
	 */
function storepress_test_plugin(): Plugin {

	load_plugin_textdomain( 'test-plugin', false, plugin_dir_path( __FILE__ ) . 'languages' );
	// Include the main class.

	/**
	 * If plugin dependent with woocommerce.
	 *
	 * @example:
	 * if ( ! class_exists( 'WooCommerce' ) ) {
	 * add_action( 'admin_notices', 'storepress_test_plugin_missing_wc_notice' );
	 * return;
	 * }
	 */

	/**
	 * If plugin has extended version
	 *
	 * @example:
	 * if ( function_exists( 'storepress_test_plugin_pro' ) ) {
	 * return storepress_test_plugin_pro();
	 * }
	 */

	return Plugin::instance();
}

	// Get the plugin running.
	add_action( 'plugins_loaded', 'storepress_test_plugin' );

	/**
	 * Declare compatibility with custom order tables for WooCommerce.
	 *
	 * @example:
	 *
	 * add_action('before_woocommerce_init', function () {
	 * if ( class_exists( '\Automattic\WooCommerce\Utilities\FeaturesUtil' ) ) {
	 * FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
	 * }
	 * });
	 */

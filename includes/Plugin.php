<?php
	/**
	 * Main Plugin Class File.
	 *
	 * @package    StorePress/TestPlugin
	 * @since      0.1.0
	 * @version    0.1.0
	 */

	namespace StorePress\TestPlugin;

	defined( 'ABSPATH' ) || die( 'Keep Silent' );

	use Exception;

	/**
	 * Class Plugin.
	 */
class Plugin {

	/**
	 * Return singleton instance of Plugin.
	 * The instance will be created if it does not exist yet.
	 *
	 * @return self The main instance.
	 * @since  0.1.0
	 */
	public static function instance(): self {
		static $instance = null;
		if ( is_null( $instance ) ) {
			$instance = new self();
		}

		return $instance;
	}

	/**
	 * Initialise the plugin.
	 *
	 * @since  0.1.0
	 */
	protected function __construct() {
		try {
			$this->includes();
			$this->hooks();
			$this->init();
		} catch ( Exception $e ) {
			wp_trigger_error( __METHOD__, $e->getMessage() );
		}

		/**
		 * Action to signal that Plugin has finished loading.
		 *
		 * @param Plugin $this Plugin Object.
		 *
		 * @since 0.1.0
		 */
		do_action( 'storepress_test_plugin_plugin_loaded', $this );
	}

	/**
	 * Plugin Absolute File.
	 *
	 * @return string
	 * @since 0.1.0
	 */
	public function get_plugin_file(): string {
		return constant( 'STOREPRESS_TEST_PLUGIN_PLUGIN_FILE' );
	}

	/**
	 * Get Plugin Version.
	 *
	 * @return string
	 * @since 0.1.0
	 */
	public function version(): string {
		static $versions;

		if ( is_null( $versions ) ) {
			$versions = get_file_data( $this->get_plugin_file(), array( 'Version' ) );
		}

		return esc_attr( $versions[0] );
	}

	/**
	 * Includes.
	 *
	 * @return bool
	 * @throws Exception When class files loading fails.
	 * @since 0.1.0
	 */
	public function includes(): bool {

		if ( file_exists( $this->vendor_path() . '/autoload_packages.php' ) ) {
			require_once $this->vendor_path() . '/autoload_packages.php';
			require_once __DIR__ . '/functions.php';

			return true;
		}

		throw new Exception( '"vendor/autoload_packages.php" file missing. Please run `composer install`' );
	}

	/**
	 * Initialize Classes.
	 *
	 * @return void
	 * @since 0.1.0
	 */
	public function init() {

		// Setup BLocks.
		$this->get_blocks();

		// Set up cache management.
		// new Extension_Cache();.

		// Initialize REST API.
		// new Extension_REST_API();.

		// Set up email management.
		// new Extension_Email_Manager();.
	}

	/**
	 * Hooks.
	 *
	 * @return void
	 * @since 0.1.0
	 */
	public function hooks() {
		// Register with hook.
	}

	/**
	 * Get Plugin basename directory name
	 *
	 * @return string
	 * @since 0.1.0
	 */
	public function basename(): string {
		return wp_basename( dirname( $this->get_plugin_file() ) );
	}

	/**
	 * Get Plugin basename
	 *
	 * @return string
	 * @since 0.1.0
	 */
	public function plugin_basename(): string {
		return plugin_basename( $this->get_plugin_file() );
	}

	/**
	 * Get Plugin directory name
	 *
	 * @return string
	 * @since 0.1.0
	 */
	public function plugin_dirname(): string {
		return dirname( plugin_basename( $this->get_plugin_file() ) );
	}

	/**
	 * Get Plugin directory path
	 *
	 * @return string
	 * @since 0.1.0
	 */
	public function plugin_path(): string {
		return untrailingslashit( plugin_dir_path( $this->get_plugin_file() ) );
	}

	/**
	 * Get Plugin directory url
	 *
	 * @return string
	 * @since 0.1.0
	 */
	public function plugin_url(): string {
		return untrailingslashit( plugin_dir_url( $this->get_plugin_file() ) );
	}

	/**
	 * Get Plugin image url
	 *
	 * @return string
	 * @since 0.1.0
	 */
	public function images_url(): string {
		return untrailingslashit( plugin_dir_url( $this->get_plugin_file() ) . 'images' );
	}

	/**
	 * Get Assets URL
	 *
	 * @return string
	 * @since 0.1.0
	 */
	public function assets_url(): string {
		return untrailingslashit( plugin_dir_url( $this->get_plugin_file() ) . 'assets' );
	}

	/**
	 * Get Asset Absolute Path
	 *
	 * @return string
	 * @since 0.1.0
	 */
	public function assets_path(): string {
		return $this->plugin_path() . '/assets';
	}

	/**
	 * Get Vendor path
	 *
	 * @return string
	 * @since 0.1.0
	 */
	public function vendor_path(): string {
		return $this->plugin_path() . '/vendor';
	}

	/**
	 * Get Vendor URL
	 *
	 * @return string
	 * @since 0.1.0
	 */
	public function vendor_url(): string {
		return untrailingslashit( plugin_dir_url( $this->get_plugin_file() ) . 'vendor' );
	}

	/**
	 * Get Node Modules build URL
	 *
	 * @return string
	 * @since 0.1.0
	 */
	public function build_url(): string {
		return untrailingslashit( plugin_dir_url( $this->get_plugin_file() ) . 'build' );
	}

	/**
	 * Get Node Modules build path
	 *
	 * @return string
	 * @since 0.1.0
	 */
	public function build_path(): string {
		return $this->plugin_path() . '/build';
	}

	/**
	 * Get Asset file make time for versioning.
	 *
	 * @param string $file Asset file name.
	 *
	 * @return int asset file make time.
	 * @since 0.1.0
	 */
	public function assets_version( string $file ): int {
		return filemtime( $this->assets_path() . $file );
	}

	/**
	 * Get includes directory absolute path
	 *
	 * @return string
	 * @since 0.1.0
	 */
	public function include_path(): string {
		return untrailingslashit( plugin_dir_path( $this->get_plugin_file() ) . 'includes' );
	}

	/**
	 * Get templates directory absolute path
	 *
	 * @return string
	 * @since 0.1.0
	 */
	public function template_path(): string {
		return untrailingslashit( plugin_dir_path( $this->get_plugin_file() ) . 'templates' );
	}

	/**
	 * Get Block Instance.
	 *
	 * @return Blocks
	 * @since 0.1.0
	 */
	public function get_blocks(): Blocks {
		return Blocks::instance();
	}
}

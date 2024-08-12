<?php
	/**
	 * Uninstall Plugin
	 *
	 * Deletes all plugin settings.
	 *
	 * @package    Storepress\TestPlugin
	 * @since      0.1.0
	 */

	namespace Storepress\TestPlugin;

	/**
	 * This file describes all uninstall logic.
	 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

	// Exit if accessed directly.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

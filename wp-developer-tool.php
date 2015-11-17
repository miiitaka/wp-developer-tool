<?php
/*
Plugin Name: WordPress Developer Tool
Plugin URI: https://github.com/miiitaka/wp-developer-tool
Description: This is a wordpress themes and plug-in developer tools.
Version: 1.0.0
Author: Kazuya Takami
Author URI: http://programp.com/
License: GPLv2 or later
Text Domain: wp-developer-tool
Domain Path: /languages
*/
new Developer_Tool();

/**
 * Basic Class
 *
 * @author  Kazuya Takami
 * @since   1.0.0
 * @version 1.0.0
 */
class Developer_Tool {

	/**
	 * Variable definition.
	 *
	 * @since 1.0.0
	 */
	private $text_domain = 'wp-developer-tool';

	/**
	 * Constructor Define.
	 *
	 * @since 1.0.0
	 */
	public function __construct () {
		add_action( 'widgets_init',   array( $this, 'widget_init' ) );

		if ( is_admin() ) {
			add_action( 'admin_init', array( $this, 'admin_init' ) );
			add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		}
	}

	/**
	 * Widget Register.
	 *
	 * @since 1.0.0
	 */
	public function widget_init () {
		require_once( plugin_dir_path( __FILE__ ) . 'includes/wp-developer-tool-admin-widget.php' );
		register_widget( 'Developer_Tool_Widget' );
	}

	/**
	 * admin init.
	 *
	 * @since   1.0.0
	 */
	public function admin_init() {
		wp_register_style( 'wp-developer-tool-admin-style', plugins_url( 'css/style.css', __FILE__ ) );
	}

	/**
	 * Add Menu to the Admin Screen.
	 *
	 * @since 1.0.0
	 */
	public function admin_menu() {
		$page = add_options_page(
			esc_html__( 'WP Developer Tool', $this->text_domain ),
			esc_html__( 'WP Developer Tool', $this->text_domain ),
			'manage_options',
			plugin_basename( __FILE__ ),
			array( $this, 'developer_settings' )
		);

		add_action( 'admin_print_styles-' . $page, array( $this, 'add_style' ) );
	}

	/**
	 * Developer Settings
	 *
	 * @since 1.0.0
	 */
	public function developer_settings() {

	}

	/**
	 * CSS admin add.
	 *
	 * @since 1.0.0
	 */
	public function add_style() {
		wp_enqueue_style( 'wp-developer-tool-admin-style' );
	}
}
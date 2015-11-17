<?php
/**
 * Admin Widget Register
 *
 * @author  Kazuya Takami
 * @version 1.0.0
 * @since   1.0.0
 */
class Developer_Tool_Widget extends WP_Widget {

	/**
	 * Variable definition.
	 *
	 * @since 1.0.0
	 */
	private $text_domain = 'wp-developer-tool';

	/**
	 * Constructor Define.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function __construct() {
		$widget_options = array( 'description' => esc_html__( 'Developer Tool Widget', $this->text_domain ) );
		parent::__construct( false, esc_html__( 'Developer Tool', $this->text_domain ), $widget_options );
	}

	/**
	 * Widget Form Display.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $instance
	 * @return string Parent::Default return is 'noform'
	 */
	public function form( $instance ) {
		if ( !isset( $instance['title'] ) ) {
			$instance['title'] = "";
		}

		$id   = $this->get_field_id( 'title' );
		$name = $this->get_field_name( 'title' );
		echo '<p><label for="' . $id . '">' . esc_html__( 'Title', $this->text_domain ) . ':</label><br>';
		printf( '<input type="text" id="%s" name="%s" value="%s" class="widefat">', $id, $name, esc_attr( $instance['title'] ) );
		echo '</p>';
	}

	/**
	 * Widget Form Update.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $new_instance
	 * @param  array $old_instance
	 * @return array Parent::Settings to save or bool false to cancel saving.
	 */
	public function update( $new_instance, $old_instance ) {
		return (array) $new_instance;
	}

	/**
	 * Widget Display.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args
	 * @param  array $instance
	 */
	public function widget( $args, $instance ) {
		/** Display widget header. */
		echo $args['before_widget'] . PHP_EOL;
		echo $args['before_title'] . PHP_EOL;
		echo esc_html( $instance['title'] ) . PHP_EOL;
		echo $args['after_title'] . PHP_EOL;

		/** Display widget body. */
		require_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
		$query = 'query_plugins';
		$arg['author'] = "miiitaka";
		$arg['fields'] = array(
				'downloaded' => true,
				'rating' => true
		);
		$plugins = plugins_api($query,$arg)->plugins;

		echo '<dl>' . PHP_EOL;

		foreach( $plugins as $plugin ) {
			echo '<dt><a href="' . esc_url( $plugin->homepage ) . '">' . esc_html( $plugin->name ) . '</a></dt>' . PHP_EOL;
			echo '<dd>' . esc_html( $plugin->downloaded ) . '&nbsp;Downloads</dd>' . PHP_EOL;
		}

		echo '</dl>' . PHP_EOL;
		echo $args['after_widget'];
	}
}
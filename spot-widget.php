<?php
/*
Plugin Name: Spot Widget
Plugin URI: http://blog.stfs.eu/
Description: A widget showing Spot GPS tracker locations
Version: 0.1
Author: Stef Sijben
Author URI: http://stfs.eu/
License: GPL3
*/

class wp_spot_widget extends WP_Widget {

	// constructor
	function wp_spot_widget() {
        parent::WP_Widget(false, $name = __('Spot GPS locations', 'wp_spot_widget') );
	}

	// widget form creation
	function form($instance) {
	/* ... */
	}

	// widget update
	function update($new_instance, $old_instance) {
		/* ... */
	}

	// widget display
	function widget($args, $instance) {
		/* ... */
	}
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("wp_spot_widget");'));

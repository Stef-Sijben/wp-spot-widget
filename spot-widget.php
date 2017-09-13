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
		// Check values
		if( $instance) {
			$title = esc_attr($instance['title']);
			$feedId = esc_attr($instance['feedId']);
		} else {
			$title = 'My latest locations';
			$feedId = '';
		}
?>

		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'wp_spot_widget'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('feedId'); ?>"><?php _e('Feed ID:', 'wp_spot_widget'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('feedId'); ?>" name="<?php echo $this->get_field_name('feedId'); ?>" type="text" value="<?php echo $feedId; ?>" />
		</p>

<?php /*		<p>
		<label for="<?php echo $this->get_field_id('textarea'); ?>"><?php _e('Textarea:', 'wp_spot_widget'); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id('textarea'); ?>" name="<?php echo $this->get_field_name('textarea'); ?>"><?php echo $textarea; ?></textarea>
		</p>*/
//<?php
	}

	// widget update
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		// Fields
		$instance['title'] = strip_tags($new_instance['title']);
		
		// TODO: Validate findmyspot feed ID
		$instance['feedId'] = strip_tags($new_instance['feedId']);
		return $instance;
	}

	// widget display
	function widget($args, $instance) {
		extract( $args );
		// these are the widget options
		$title = apply_filters('widget_title', $instance['title']);
		$text = "foo";
		$textarea = $instance['textarea'];
		echo $before_widget;
		// Display the widget
		echo '<div class="widget-text wp_spot_widget_box">';

		// Check if title is set
		if ( $title ) {
		  echo $before_title . $title . $after_title;
		}

		// Check if text is set
		if( $text ) {
		  echo '<p class="wp_spot_widget_text">'.$text.'</p>';
		}
		// Check if textarea is set
		if( $textarea ) {
		 echo '<p class="wp_spot_widget_textarea">'.$textarea.'</p>';
		}
		echo '</div>';
		echo $after_widget;
	}
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("wp_spot_widget");'));

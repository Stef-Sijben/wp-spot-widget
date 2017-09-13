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
		
		add_action('wp_enqueue_scripts', array($this, 'scripts'));
	}

	function scripts() {
		if (is_active_widget(false, false, $this->id_base, true)) {
			// TODO: load scripts here
			// TODO: first make GMaps API key a plugin setting
		}
	}

	// widget form creation
	function form($instance) {
		// Check values
		if( $instance) {
			$title    = esc_attr($instance['title']);
			$feedId   = esc_attr($instance['feedId']);
			$gMapsKey = esc_attr($instance['gMapsKey']);
		} else {
			$title    = 'My latest locations';
			$feedId   = '';
			$gMapsKey = '';
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

		<p>
		<label for="<?php echo $this->get_field_id('gMapsKey'); ?>"><?php _e('Google maps API v3 key:', 'wp_spot_widget'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('gMapsKey'); ?>" name="<?php echo $this->get_field_name('gMapsKey'); ?>" type="text" value="<?php echo $gMapsKey; ?>" />
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
		
		// TODO: Validate findmyspot feed ID
		$instance['gMapsKey'] = strip_tags($new_instance['gMapsKey']);
		return $instance;
	}

	// widget display
	function widget($args, $instance) {
		// these are the widget options
		$title = apply_filters('widget_title', $instance['title']);
		$feedId = $instance['feedId'];
		$gMapsKey = $instance['gMapsKey'];

		// Don't display a widget with no feed ID set
		if (!($feedId && $gMapsKey)) {
			return;
		}

		// Load external JS dependencies
		wp_enqueue_script("wp_spot_widget_gmaps", "https://maps.googleapis.com/maps/api/js?key=" . $gMapsKey,
				array(), null);
		wp_enqueue_script("spot-live-widget", "//d3ra5e5xmvzawh.cloudfront.net/live-widget/2.0/spot-main-min.js",
				array("jquery"), null);


		extract( $args );
		echo $before_widget;
		
		// Display the widget
		// Check if title is set
		if ( $title ) {
		  echo $before_title . $title . $after_title;
		}
?>

		<div id="<?php echo $widget_id; ?>_map"></div>
		<script type="text/javascript">
			jQuery(function() {
				jQuery('#<?php echo $widget_id; ?>_map').spotLiveWidget({ 
					feedId: '<?php echo $feedId; ?>',
					mapType: 'HYBRID',
					width: jQuery('#<?php echo $widget_id; ?>_map').width(),
					height: 300,
					showLegend: false
				});
			});
		</script>

<?php
		echo $after_widget;
	}
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("wp_spot_widget");'));

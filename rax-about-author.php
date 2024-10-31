<?php
/*
Plugin Name: RAX - About Author widget
Plugin URI: http://www.programmingfacts.com/rax-about-author-wordpress-widget
Description: Adds an widget to give introduction About Author to your sidebar.
Author: Rakshit Patel
Version: 1.0
Author URI: http://www.programmingfacts.com
*/

// Register widget
add_action('widgets_init', 'rax_about_author_init');

// function to Register widget
function rax_about_author_init() {
	register_widget('rax_about_author_widget');
}


class rax_about_author_widget extends WP_Widget {
	
    // initilization
    function rax_about_author_widget() {
        parent::WP_Widget(false, $name = 'About Author');
    }
	
	function widget($args, $instance) {
		
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title']);
		$rax_author_name = empty($instance['rax_author_name']) ? '' : $instance['rax_author_name'];
		$rax_author_url = empty($instance['rax_author_url']) ? '' : $instance['rax_author_url'];
		$rax_author_image = empty($instance['rax_author_image']) ? '' : $instance['rax_author_image'];
		$rax_image_position = empty($instance['rax_image_position']) ? '' : $instance['rax_image_position'];
		$rax_author_description = empty($instance['rax_author_description']) ? '' : $instance['rax_author_description'];
		$rax_twitter_username = empty($instance['rax_twitter_username']) ? '' : $instance['rax_twitter_username'];

		echo '<style>
				.rax-about-author div {
					line-height:20px;
				}
			  </style>';

		// show widget starts
		echo $before_widget . '<div class="rax-about-author">' . $before_title . $title . $after_title;
		
		// show author image
		if($rax_author_image) {
			echo '<img src="'.$rax_author_image.'" alt="'.$rax_author_name.'" align="'.$rax_image_position.'" style="padding:2px; margin:5px; border: 2px solid; margin-'.$rax_image_position.':0px;" />';
		}
		
		// show author name with url if url added
		if($rax_author_url) {
			echo '<a href="'.$rax_author_url.'"><h4 style="clear:none;"><strong>' . $rax_author_name . '</strong></h4></a>';
		}
		else {
			echo $rax_author_name;
		}
		echo "<div>".$rax_author_description."</div>";
		
		// show web url
		if($rax_author_url) {
			echo '<div><strong>Web:</strong> <a href="'.$rax_author_url.'">'.$rax_author_url.'</a></div>';
		}
		
		// show twitter follow link
		if($rax_twitter_username) {
			echo '<div><strong>Follow Me:</strong> <a href="http://www.twitter.com/'.$rax_twitter_username.'">@'.$rax_twitter_username.'</a></div>';
		}
		echo '</div>' . $after_widget;
		
	}
	
	// update function to save data
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['rax_author_name'] = strip_tags($new_instance['rax_author_name']);
		$instance['rax_author_url'] = strip_tags($new_instance['rax_author_url']);
		$instance['rax_author_image'] = strip_tags($new_instance['rax_author_image']);
		$instance['rax_image_position'] = strip_tags($new_instance['rax_image_position']);
		$instance['rax_author_description'] = $new_instance['rax_author_description'];
	 	$instance['rax_twitter_username'] = strip_tags($new_instance['rax_twitter_username']);
		
		return $instance;
	}	
	
	// form to collect widget data
	function form($instance) {
		// set the Defaults
		$instance = wp_parse_args( (array) $instance, array('title'=>'About Author', 'rax_author_name'=>'Rakshit Patel', 'rax_author_url'=>'', 'rax_author_image'=>'', 'rax_image_position'=>'left', 'rax_author_description'=>'','rax_twitter_username'=>'raxit4u2') );		
		$title = htmlspecialchars($instance['title'], ENT_QUOTES);			
		$rax_author_name = htmlspecialchars($instance['rax_author_name'], ENT_QUOTES);			
		$rax_author_url = htmlspecialchars($instance['rax_author_url'], ENT_QUOTES);			
		$rax_author_image = htmlspecialchars($instance['rax_author_image'], ENT_QUOTES);			
		$rax_image_position = htmlspecialchars($instance['rax_image_position'], ENT_QUOTES);
		$rax_author_description = htmlspecialchars($instance['rax_author_description'], ENT_QUOTES);			
		$rax_twitter_username = htmlspecialchars($instance['rax_twitter_username'], ENT_QUOTES);			

		// Set options here
		echo '<p>
				<label for="' .$this->get_field_id('title') . '">Title: [Widget Title]</label>
				<input style="width:100%;" id="' .$this->get_field_id('title') . '" name="' .$this->get_field_name('title') . '" type="text" value="'.$title.'" />
			  </p>';
		echo '<p>
				<label for="' .$this->get_field_id('rax_author_name') . '">Name: [e.g. Rakshit Patel]</label>
				<input style="width:100%;" id="' .$this->get_field_id('rax_author_name') . '" name="' .$this->get_field_name('rax_author_name') . '" type="text" value="'.$rax_author_name.'" />
			  </p>';
		echo '<p>
				<label for="' .$this->get_field_id('rax_author_url') . '">URL: [e.g. http://www.google.com]</label>
				<input style="width:100%;" id="' .$this->get_field_id('rax_author_url') . '" name="' .$this->get_field_name('rax_author_url') . '" type="text" value="'.$rax_author_url.'" />
			  </p>';
		echo '<p>
				<label for="' .$this->get_field_id('rax_author_image') . '">Image: [e.g. Full Image Path]</label>
				<input style="width:100%;" id="' .$this->get_field_id('rax_author_image') . '" name="' .$this->get_field_name('rax_author_image') . '" type="text" value="'.$rax_author_image.'" />
			  </p>';
		echo '<p>
				<label for="' .$this->get_field_id('rax_image_position') . '">Image Position: [e.g. left or right]</label>
				<input style="width:100%;" id="' .$this->get_field_id('rax_image_position') . '" name="' .$this->get_field_name('rax_image_position') . '" type="text" value="'.$rax_image_position.'" />
			  </p>';
		echo '<p>
				<label for="' . $this->get_field_id('rax_author_description') . '">Description: [e.g. Introduction]</label>
				<textarea style="width:100%;" rows="10" id="' . $this->get_field_id('rax_author_description') . '" name="' . $this->get_field_name('rax_author_description') . '">'.$rax_author_description.' </textarea>
			  </p>';	
		echo '<p>
				<label for="' .$this->get_field_id('rax_twitter_username') . '">Twitter Username: [e.g. raxit4u2]</label>
				<input style="width:100%;" id="' .$this->get_field_id('rax_twitter_username') . '" name="' .$this->get_field_name('rax_twitter_username') . '" type="text" value="'.$rax_twitter_username.'" />
			  </p>';
			  
			  
		
	}
	
}
?>
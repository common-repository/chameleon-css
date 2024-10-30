<?php

add_action( 'widgets_init', 'ccss_load_widgets' );

function ccss_load_widgets() {
	register_widget( 'CCSS_Widget' );
}

class CCSS_Widget extends WP_Widget {

	function CCSS_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'ccss', 'description' => 'a list of css that user can manually select to load it on the fly' );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'ccss-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'ccss-widget', 'CCSS List', $widget_ops, $control_ops );
	}


	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$exclude = $instance['exclude'];
		$option = "exclude=" . $exclude;

		echo $before_widget;
		if ( $title ) echo $before_title . $title . $after_title;
		ccss_generate_list($option);
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['exclude'] = strip_tags( $new_instance['exclude'] );

		return $instance;
	}

	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => '', 'exclude' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<!-- Exclude: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'exclude' ); ?>">Exclude (id) <small>example: 1,2,3</small></label>
			<input id="<?php echo $this->get_field_id( 'exclude' ); ?>" name="<?php echo $this->get_field_name( 'exclude' ); ?>" value="<?php echo $instance['exclude']; ?>" style="width:100%;" />
		</p>

	<?php
	}
}

?>
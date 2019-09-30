<?php

class Wee_Widget_Building extends WP_Widget {

	public function __construct() {
		parent::__construct( 'wee_building', __( 'Wee The Property' ), array(
			'description' => 'Виджет в котором выводится на экран список кастомных постов.'
		) );
	}

	public function widget( $args, $instance ) {
		add_action( 'wp_footer', 'wee_enqueue_scripts' );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>

    <!-- Фильтр и поиск по категории -->
    <form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="post" id="post-date-filter">
			<?php
			if ( $terms = get_terms( array( 'taxonomy' => 'area', 'hide_empty' => false ) ) ) :
				echo '<select name="categoryfilter">';
				foreach ( $terms as $term ) :
					echo '<option value="' . $term->term_id . '">' . $term->name . '</option>';
				endforeach;
				echo '</select>';
			endif;
			?>
      <button id="btn-search">Поиск по категории</button>
      <input type="hidden" name="action" value="customfilter">
    </form>
    <div id="filtering-results"></div>

		<?php echo $args['after_widget'];
	}

	public function form( $instance ) {
		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			$title = __( 'New title' );
		}
		?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
             name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
             value="<?php echo esc_attr( $title ); ?>"/>
    </p>
		<?php
	}
}

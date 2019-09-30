<?php

function posts_filters() {
	$args = array(
		'orderby' => 'date',
		'order'   => $_POST['date']
	);

	if ( isset( $_POST['categoryfilter'] ) ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'area',
				'field'    => 'id',
				'terms'    => $_POST['categoryfilter']
			)
		);
	}

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) :
		echo '<ul>';
		while ( $query->have_posts() ): $query->the_post();
			echo '<li><a href="' . get_permalink( $query->post->ID ) . '">' . $query->post->post_title . '</a></li>';
		endwhile;
		echo '</ul>';
		wp_reset_postdata();
	else :
		echo 'Нет постов в данной категории.';
	endif;

	die();
}

<?php

/**
 * Create custom post type and taxonomy.
 */
function wee_register_post_type() {
	register_post_type( 'building', array(
		'labels'           => array(
			'name'          => __( 'Building' ),
			'singular_name' => __( 'Building' ),
			'all_items'     => __( 'All Building' ),
			'add_new'       => 'Add New',
			'search_items'  => 'Search Building',
			'not_found'     => 'Create your first custom post type.'
		),
		'public'           => true,
		'menu_position'    => 3,
		'menu_icon'        => 'dashicons-admin-multisite',
		'has_archive'      => true,
		'supports'         => array(
			'title',
			'editor',
			'thumbnail',
			'page-attributes',
			'post-format'
		),
		'rewrite'          => array(
			'slug'       => 'building',
			'with_front' => false,
			'feeds'      => false,
			'pages'      => true,
		),
		'delete_with_user' => null,
		'permalink_epmask' => EP_NONE,
//        'taxonomies'       => array('area')
	) );

	register_taxonomy( 'area', 'building', array(
		'labels'       => array(
			'name'          => _x( 'Areas' ),
			'singular_name' => _x( 'Area' ),
			'search_items'  => __( 'Search Areas' ),
			'all_items'     => __( 'All Areas' ),
			'edit_item'     => __( 'Edit Areas' ),
			'update_item'   => __( 'Update Areas' ),
			'add_new_item'  => __( 'Add New Areas' ),
		),
		'public'       => true,
		'description'  => '',
		'hierarchical' => true,

	) );

	register_taxonomy_for_object_type( 'area', 'building' );
}

/**
 * Create shortcode for custom post type.
 *
 * Link to the source where the code was taken:
 * https://code.tutsplus.com/tutorials/create-a-shortcode-to-list-posts-with-multiple-parameters--wp-32199
 */
add_shortcode( 'list-building', 'wee_display_builder_list' );
function wee_display_builder_list() {
	ob_start();
	$query = new WP_Query( array(
		'post_type' => 'building',
//		'posts_per_page' => -1,
//		'order' => 'ASC',
//		'orderby' => 'title',
	) );
	if ( $query->have_posts() ) { ?>
    <ul class="builder-listing">
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
        <li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </li>
			<?php endwhile;
			wp_reset_postdata(); ?>
    </ul>
		<?php $my_var = ob_get_clean();

		return $my_var;
	}
}

/**
 * Here we are looking for a template in the folder with the current theme.
 */
add_filter( 'template_include', 'include_template_function', 1 );
function include_template_function( $template_path ) {
	if ( get_post_type() == 'building' ) {
		if ( is_single() ) {

			if ( $theme_file = locate_template( array( 'single-page.php' ) ) ) {
				$template_path = $theme_file;
			} else {
				$template_path = plugin_dir_path( __FILE__ ) . '/single-page.php';
			}
		}
	}

	return $template_path;
}

//TODO
//add_filter( 'widget_categories_args', 'display_custom_category', 10, 2 );
function display_custom_category( $cat_args, $instance ) {
//  var_dump($cat_args);
	return $cat_args;
}
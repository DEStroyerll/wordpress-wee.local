<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <h1><?php the_title(); ?></h1>
	<?php
	the_content();
	?>
  <h3><?php the_field( 'building_name' ); ?></h3>
  <p><?php the_field( 'location_coordinates' ); ?></p>
  <p><?php echo "<strong>Тип строения: </strong>";
		the_field( 'build_type' ); ?></p>
  <p><?php echo "<strong>Количество этажей: </strong>";
		the_field( 'number_of_floors' ); ?></p>
  <p>
		<?php
		$image = get_field( 'image' );
		if ( ! empty( $image ) ): ?>
      <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
		<?php endif; ?>
  </p>
  <table class="wp-list-table widefat fixed striped posts" id="dn-table">
    <thead>
    <tr>
      <td><strong><?php echo _( 'Площадь' ); ?></strong></td>
      <td><strong><?php echo _( 'Количество комнат' ); ?></strong></td>
      <td><strong><?php echo _( 'Балкон' ); ?></strong></td>
      <td><strong><?php echo _( 'Санузел' ); ?></strong></td>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td><?php the_field( 'square' ); ?></td>
      <td><?php the_field( 'number_of_rooms' ); ?></td>
      <td><?php the_field( 'balcony' ); ?></td>
      <td><?php the_field( 'bathroom' ); ?></td>
    </tr>
    </tbody>
  </table>
	<?php

	?>
	<?php edit_post_link( __( 'Редактировать информацию' ) ); ?>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
  </article>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
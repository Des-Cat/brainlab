<?php get_header(); ?>
<?php $post_id = get_the_ID(); ?>

<main class="container">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<article class="tour">
			<h1><?php the_field('tour_name'); ?></h1>
			<div class="tour-category">
				<?php $terms = get_the_terms( $post_id, 'tour-categories' );
				if ( $terms && ! is_wp_error( $terms ) ) :
					foreach ( $terms as $term ) {
						echo '<a href="' . esc_url( get_term_link( $term ) ) . '">' . $term->name . '</a>';
					}
				endif; ?>
			</div>

			<div class="tour-info">
				<div class="tour-description">
					<h3>Tour excerpt:</h3>
					<?php the_field('tour_excerpt'); ?>
				</div>
				<div class="tour-dates">
					<h3>Tour dates:</h3>
					<?php
					$tour_dates = get_field('tour_date_repeater');
					foreach ($tour_dates as $date) {
						echo $date['tour_date'] . "<br>";
					}
					?>
				</div>
			</div>

			<div class="tour-price">
				<h3>Price:</h3>
				<p><?php the_field('tour_price'); ?> $</p>
			</div>

		</article>

	<?php endwhile; else: ?>
		<p>No tours were found.</p>
	<?php endif; ?>
</main>



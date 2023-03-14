<?php get_header(); ?>
<main class="container">
	<?php
	$args = array(
		'post_type' => 'tour'
	);
	$the_query = new WP_Query( $args );
	?>
	<?php if ( $the_query->have_posts() ) : ?>

		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

            <article class="tour">

                <h2 class="tour-title"><a href="<?php the_permalink(); ?>"><?php the_field('tour_name'); ?></a></h2>
                <h3 class="tour-category"><?php the_field('tour_category'); ?></h3>

                <div class="tour-dates">
                    <h3 class="tour-dates-label">Tour Dates:</h3>
                    <ul class="tour-dates-list">
						<?php
						$tour_dates = get_field('tour_date_repeater');
						if ($tour_dates) {
                            foreach ($tour_dates as $date) {
                                echo '<li>' . $date['tour_date'] . '</li>';
                            }
						}
						else {
						    echo 'Даты тура не определены.';
                        }

						?>
                    </ul>
                </div>

            </article>

		<?php endwhile; ?>

		<?php wp_reset_postdata(); ?>

	<?php else : ?>

        <p>No tours found</p>

	<?php endif; ?>

</main>


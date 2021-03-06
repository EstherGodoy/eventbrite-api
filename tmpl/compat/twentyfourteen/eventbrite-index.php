<?php
/**
 * The template for displaying all Eventbrite events (index), and archives (sorted by organizer or venue).
 */

get_header(); ?>

<div id="main-content" class="main-content">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<header class="page-header">
				<h1 class="page-title">
					<?php the_title(); ?>
				</h1>
			</header><!-- .page-header -->

			<?php
				// Set up and call our Eventbrite query.
				$events = new Eventbrite_Query( $query = apply_filters( 'eventbrite_query_args', array(
					// 'display_private' => false, // boolean
					// 'nopaging' => false,        // boolean
					// 'limit' => null,            // integer
					// 'organizer_id' => null,     // integer
					// 'p' => null,                // integer
					// 'post__not_in' => null,     // array of integers
					// 'venue_id' => null,         // integer
					// 'category_id' => null,      // integer
					// 'subcategory_id' => null,   // integer
					// 'format_id' => null,        // integer
					// 'order_by' => null,         // string
					// 'start_date' => null,       // string
					// 'end_date' => null,         // string
					// 'status' => null            // string
				) ) );
			?>
			
			<div class="eventbrite-calendar-icons">
                <a href="#" class="event-display-list active"> <i class="fa fa-list"></i></a>
                <a href="#" class="event-display-calendar"><i class="fa fa-calendar-o"></i></a>
            </div><!-- .calendar-icons -->  
			
        	<article class="hentry eventbrite-event-calendar">
                <?php eventbrite_show_calendar( $query ); ?>
            </article>
			
			<div class="eventbrite-event-list">
				<?php
					if ( $events->have_posts() ) :
						while ( $events->have_posts() ) : $events->the_post(); ?>

							<article id="event-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="post-thumbnail">
									<?php the_post_thumbnail( 'eventbrite-event' ); ?>
								</div>

								<header class="entry-header">

									<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

									<div class="entry-meta">
										<?php eventbrite_event_meta(); ?>

										<?php eventbrite_edit_post_link( __( 'Edit', 'eventbrite_api' ), '<span class="edit-link">', '</span>' ); ?>
									</div><!-- .entry-meta -->
								</header><!-- .entry-header -->

								<div class="entry-content">
									<?php eventbrite_ticket_form_widget(); ?>
								</div><!-- .entry-content -->
							</article><!-- #event-## -->

						<?php endwhile;

						// Previous/next post navigation.
						eventbrite_paging_nav( $events );

					else :
						// If no content, include the "No posts found" template.
						get_template_part( 'content', 'none' );

					endif;

					// Return $post to its rightful owner.
					wp_reset_postdata();
				?>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->
	<?php get_sidebar( 'content' ); ?>
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();

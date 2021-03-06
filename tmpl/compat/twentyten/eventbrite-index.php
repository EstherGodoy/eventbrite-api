<?php
/**
 * The template for displaying all Eventbrite events (index), and archives (sorted by organizer or venue).
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">
				<h1 class="page-title">
					<?php the_title(); ?>
				</h1>

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

	        	<div class="hentry eventbrite-event-calendar">
	                <?php eventbrite_show_calendar( $query ); ?>
	            </div>
				
				<div class="eventbrite-event-list">
					<?php
						if ( $events->have_posts() ) :
							while ( $events->have_posts() ) : $events->the_post(); ?>
								<div id="event-<?php the_ID(); ?>" <?php post_class(); ?>>
									<div class="post-thumbnail">
										<?php the_post_thumbnail( 'eventbrite-event' ); ?>
									</div>
									
									<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

									<div class="entry-meta">
										<?php eventbrite_event_meta(); ?>
									</div><!-- .entry-meta -->

									<div class="entry-content">
										<?php eventbrite_ticket_form_widget(); ?>
									</div><!-- .entry-content -->

									<div class="entry-utility">
										<?php eventbrite_edit_post_link( __( 'Edit', 'eventbrite_api' ), '<span class="edit-link">', '</span>' ); ?>
									</div><!-- .entry-utility -->
								</div><!-- #post-## -->

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
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

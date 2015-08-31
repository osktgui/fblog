<?php if ( !defined( 'ABSPATH' ) ) exit;

/*

	Template Name: Blog

	1 - RETRIEVE DATA

	2 - POSTS

		2.1 - Featured Posts
		2.2 - Recent Posts
		2.3 - Sidebar

*/

/*===============================================

	R E T R I E V E   D A T A
	Get a required page data

===============================================*/

	global
		$st_Options,
		$st_Settings,
		$paged;

		$st_ = array();

		// Template name
		$st_['t'] = !empty( $st_Settings['blog_template'] ) ? $st_Settings['blog_template'] : 'default';

		// Get custom sidebar
		$st_['sidebar'] = st_get_post_meta( $post->ID, 'sidebar_value', true, 'Default Sidebar' );
	
		// Get sidebar position
		$st_['sidebar_position'] = st_get_post_meta( $post->ID, 'sidebar_position_value', true, 'right' );

			// Re-define global $content_width if sidebar not exists
			if ( $st_['sidebar_position'] == 'none' ) {
				$content_width = $st_Options['global']['images']['large']['width']; }

		// Subtitle
		$st_['subtitle'] = get_post_meta( $post->ID, 'subtitle_value', true );

		// Is blog?
		$st_['is_blog'] = true;

		// Featured posts qty
		$st_['featured_posts_per_page'] = !empty( $st_Settings['sticky_qty'] ) ? $st_Settings['sticky_qty'] : $st_Options['panel']['major']['blog']['featured']['sticky'];

		// Paged
		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged'); }
		
		elseif ( get_query_var('page') ) {
			$paged = get_query_var('page'); }
		
		else {
			$paged = 1; }
		
		$st_['paged'] = $paged;


/*===============================================

	P O S T S
	Display posts archive

===============================================*/

	get_header();

		?>
		
			<div id="content-holder" class="sidebar-position-<?php echo $st_['sidebar_position']; ?>">

				<?php
					/*-------------------------------------------
						2.1 - Featured Posts
					-------------------------------------------*/

					if ( $paged == 1 && get_option('sticky_posts') ) {

						$st_['args'] = array(
							'post__in'				=> get_option('sticky_posts'),
							'posts_per_page'		=> $st_['featured_posts_per_page'],
							'order'					=> 'DESC',
							'orderby'				=> 'date',
							'paged'					=> 1,
							'post_status'			=> 'publish',
							'ignore_sticky_posts'	=> 1
						);


						/*--- Loop -----------------------------*/

						$st_query_feat = new WP_Query( $st_['args'] ); ?>

							<div class="posts-featured-wrapper">

								<?php

									$st_['postcount'] = 0;
									$st_['featcount'] = 0;
									$st_['priority'] = 'odd';


									while ( $st_query_feat->have_posts() ) : $st_query_feat->the_post();  

										include( locate_template( '/includes/posts/featured.php' ) );

									endwhile;


								?>

								<div class="clear"><!-- --></div>

							</div><!-- .posts-$t-wrapper --><?php

					}


					// Sidebar Ad B
					get_template_part( '/includes/sidebars/sidebar_ad_b' );


				?>

				<div id="content-box">
		
					<div>

						<div>

							<?php

								/*--- Page title -----------------------------*/

								if ( !is_front_page() ) {

									if ( have_posts() ) :
										while ( have_posts() ) : the_post(); 

											echo '<div id="term">';

												// Title
												echo '<div class="term-title"><h1>' . get_the_title() . ( $st_['subtitle'] ? ' <span class="title-sub">' . $st_['subtitle'] . '</span>' : '' ) . '</h1></div>';

												// Content
												if ( get_the_content() ) {
													echo '<div class="term-description">'; the_content(); echo '</div>'; }

											echo '</div><div class="clear"><!-- --></div>';

										endwhile;
									endif;

								}



								/*-------------------------------------------
									2.2 - Recent Posts
								-------------------------------------------*/

								$st_['qty'] = get_option( 'posts_per_page' );

								$st_['args_recent'] = array(
									'showposts'				=> $st_['qty'],
									'orderby'				=> 'date',
									'paged'					=> $st_['paged'],
									'post_status'			=> 'publish',
									'ignore_sticky_posts'	=> 1,
									'post__not_in'			=> !empty( $st_Settings['sticky_exclude'] ) && $st_Settings['sticky_exclude'] == 'yes' ? get_option('sticky_posts') : ''
								);

								$st_query = new WP_Query();
								$st_query->query( $st_['args_recent'] );


								/*--- Loop -----------------------------*/

								while ( $st_query->have_posts() ) : $st_query->the_post();
					
									include( locate_template( '/includes/posts/' . $st_['t'] . '.php' ) );
					
								endwhile;
						


								// Pagination
								if ( function_exists('wp_pagenavi') ) {
									?><div id="wp-pagenavibox"><?php wp_pagenavi( array( 'query' => $st_query ) ); ?></div><?php } 
								else {
									?><div id="but-prev-next"><?php next_posts_link( __( 'Older posts', 'strictthemes' ), $st_query->max_num_pages ); previous_posts_link( __( 'Newer posts', 'strictthemes' ) ); ?></div><?php }



							?>

							<div class="clear"><!-- --></div>

						</div>
			
					</div>
				
				</div><!-- #content-box -->

				<?php

					/*-------------------------------------------
						2.2 - Sidebar
					-------------------------------------------*/

					if ( !isset( $st_['sidebar_position'] ) || !empty( $st_['sidebar_position'] ) && $st_['sidebar_position'] != 'none' ) {
						get_sidebar(); }

				?>

				<div class="clear"><!-- --></div>

			</div><!-- #content-holder -->
		
		<?php

	get_footer();

?>
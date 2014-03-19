<?php
/*
Template Name: Press
*/

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="module-central">

				<h1><?php the_title(); ?></h1>
				<div class="border-blanc"></div>

					<?php
						$args = array(
							'post_type' 		=> 'presse', 	//Costum type Proyectos			
							'order'				=> 'DESC',		// List in ascending order
							'orderby'      		=> 'id',		// List them in their menu order
							'posts_per_page'	=>   -1, 		// Show the last one
						);

						$QueryPresse = new WP_Query($args);
					?>
					<div class="grid">

					<?php /* Start the Loop */ ?>
					<?php while ($QueryPresse->have_posts()) : $QueryPresse->the_post(); ?><!--
					--><div class="module-presse">
							<a class="fancybox" href="<?php the_field('detail_image_presse') ?>">
								<?php $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'imgPresse' ); ?>
								<?php echo '<img src="' . $image_src[0]  . '"  />'; ?>
							</a>
							<div class="module-presse-texte">
								<h3><?php the_title(); ?></h3>
								<p><?php the_content(); ?></p>
								<a class="fancybox lire-suite" href="<?php the_field('detail_image_presse') ?>">Lire l'article</a>
							</div>
						</div><!--
					--><?php endwhile; // end of the loop. ?>
				</div><?php /* .grid */ ?>
			</div><?php /* .grid */ ?>

			<?php wp_reset_postdata(); ?>

			<?php while ( have_posts() ) : the_post(); ?>
				<!-- on capture le thumbnail pour le background -->
				<?php $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'full' ); ?>
				<?php $image_bg = $image_src[0]; ?>
			<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<script type="text/javascript">
		//======= Home ========//
		jQuery(function($){

			$.supersized({

				// Functionality
				start_slide				:	0,			// Start slide (0 is random)
				new_window				:	1,			// Image links open in new window/tab
				image_protect			:	1,			// Disables image dragging and right click with Javascript

				// Size & Position
				min_width				:	0,			// Min width allowed (in pixels)
				min_height				:	0,			// Min height allowed (in pixels)
				vertical_center			:	1,			// Vertically center background
				horizontal_center		:	1,			// Horizontally center background
				fit_always				:	0,			// Image will never exceed browser width or height (Ignores min. dimensions)
				fit_portrait			:	1,			// Portrait images will not exceed browser height
				fit_landscape			:	0,			// Landscape images will not exceed browser width

				// Components
				slides					:	[			// Slideshow Images
													{image : '<?php echo $image_bg; ?>', title : 'Restaurant Esprit du 12eme'}
											]
				
			});
		});
	</script>
<?php get_footer(); ?>
<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sprit
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
				
					<?php 
						$args = array(
							'post_type' 	=> 'page',
							//'page_id' 		=> '37',
							'post__in' 		=> array( 37, 186 )
						);

				        $home = new WP_Query($args);
					?>

					<?php while ($home->have_posts()) : $home->the_post(); ?>
						<?php $icl_object_id_menu = icl_object_id('91', 'page', true); ?>
						<?php $icl_object_id_vino = icl_object_id('7', 'page', true); ?>
						<?php $icl_object_id_foto = icl_object_id('11', 'page', true); ?>
						<?php $icl_object_id_resa = icl_object_id('9', 'page', true); ?>

						<?php ( ICL_LANGUAGE_CODE == 'fr' ) ? $menu_txt = "Le menu" : $menu_txt = "Menu" ?>
						<?php ( ICL_LANGUAGE_CODE == 'fr' ) ? $vino_txt = "Vinoteca" : $vino_txt = "Vinoteca" ?>
						<?php ( ICL_LANGUAGE_CODE == 'fr' ) ? $foto_txt = "Photos" : $foto_txt = "Photos" ?>
						<?php ( ICL_LANGUAGE_CODE == 'fr' ) ? $resa_txt = "Réservation" : $resa_txt = "Booking" ?>
						
						<div class="module-home-container">
							<a href="<?php echo esc_url( get_permalink( $icl_object_id_menu ) ); ?>" class="module-home module-home-up module-home-left"><span><?php echo $menu_txt?></span></a>
							<a href="<?php echo esc_url( get_permalink( $icl_object_id_vino ) ); ?>" class="module-home module-home-up"><span><?php echo $vino_txt?></span></a>
							<a href="<?php echo esc_url( get_permalink( $icl_object_id_foto ) ); ?>" class="module-home module-home-down module-home-left"><span><?php echo $foto_txt?></span></a>
							<a href="<?php echo esc_url( get_permalink( $icl_object_id_resa ) ); ?>" class="module-home module-home-down"><span><?php echo $resa_txt?></span></a>
						</div>
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

<?php
/*
Template Name: Newsletter
*/

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="module-newsletter">
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						$argsFr = array(
							'prepend' => '<h1>Newsletter</h1><p>Recevez nos actualités !</p>', 
							'showname' => false,
							'nametxt' => 'Name:', 
							'nameholder' => 'Name...', 
							'emailtxt' => 'Email : ',
							'emailholder' => '', 
							'showsubmit' => true, 
							'submittxt' => 'ENVOYER', 
							'jsthanks' => false,
							'thankyou' => 'Nous vous remercions de votre souscription à nôtre newsletter !'
						);

						$argsEn = array(
							'prepend' => '<h1>Newsletter</h1><p>Receive our notifications!</p>', 
							'showname' => false,
							'nametxt' => 'Name:', 
							'nameholder' => 'Name...', 
							'emailtxt' => 'Email : ',
							'emailholder' => '', 
							'showsubmit' => true, 
							'submittxt' => 'SUBMIT', 
							'jsthanks' => false,
							'thankyou' => 'Thank you for subscribing to our mailing list !'
						);
						

						if ( ICL_LANGUAGE_CODE == 'fr' ) {
							echo smlsubform($argsFr);	
						} else {
							echo smlsubform($argsEn);
						}
					?>

					<!-- on capture le thumbnail pour le background -->
					<?php $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'full' ); ?>
					<?php $image_bg = $image_src[0]; ?>
				<?php endwhile; // end of the loop. ?>
			</div>
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
<?php
/*
Template Name: Photos
*/

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<!--Arrow Navigation-->
				<a id="prevslide" class="load-item"></a>
				<a id="nextslide" class="load-item"></a>
				
				<!--Control Bar-->
				<div id="controls-wrapper" class="load-item">
					<div id="controls">
						
						<!--Navigation-->
						<div class="one-half clearfix">
							<ul id="slide-list"></ul>
						</div><!--
					--><div class="one-half button-visite clearfix">
							<?php $icl_object_id = icl_object_id('122', 'page', true); ?>
							<a href="<?php echo esc_url( get_permalink($icl_object_id) ); ?>" class="button">DÉMARRER LA VISITE VIRTUELLE</a>					
						</div>

					</div>
				</div>
			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
	$args = array(
		'post_parent'    => $post->ID,			// For the current post
		'post_type'      => 'attachment',		// Get all post attachments
		'post_mime_type' => 'image',			// Only grab images
		'order'		 => 'ASC',			// List in ascending order
		'orderby'        => 'rand',			// List them in their menu order
		'numberposts'    => -1, 			// Show all attachments
		'post_status'    => null,			// For any post status
	);
 
	// Retrieve the items that match our query; in this case, images attached to the current post.
	$attachments = get_posts($args); ?>


	
	<script type="text/javascript">
		
		jQuery(function($){
			
			$.supersized({
			
				// Functionality
				slideshow               :   1,			// Slideshow on/off
				autoplay				:	0,			// Slideshow starts playing automatically
				start_slide             :   1,			// Start slide (0 is random)
				stop_loop				:	0,			// Pauses slideshow on last slide
				random					: 	0,			// Randomize slide order (Ignores start slide)
				slide_interval          :   3000,		// Length between transitions
				transition              :   6, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
				transition_speed		:	1000,		// Speed of transition
				new_window				:	1,			// Image links open in new window/tab
				pause_hover             :   0,			// Pause slideshow on hover
				keyboard_nav            :   1,			// Keyboard navigation on/off
				performance				:	1,			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
				image_protect			:	1,			// Disables image dragging and right click with Javascript
														   
				// Size & Position						   
				min_width		        :   0,			// Min width allowed (in pixels)
				min_height		        :   0,			// Min height allowed (in pixels)
				vertical_center         :   1,			// Vertically center background
				horizontal_center       :   1,			// Horizontally center background
				fit_always				:	0,			// Image will never exceed browser width or height (Ignores min. dimensions)
				fit_portrait         	:   1,			// Portrait images will not exceed browser height
				fit_landscape			:   0,			// Landscape images will not exceed browser width
														   
				// Components							
				slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
				thumb_links				:	1,			// Individual thumb links for each slide
				thumbnail_navigation    :   0,			// Thumbnail navigation
				slides 					:  	[			// Slideshow Images
															<?php 	foreach ($attachments as $attachment) {					
																$image_attributes = wp_get_attachment_image_src( $attachment->ID, 'full'); // returns an array
																$image_background = $image_attributes[0];
																$slider = "{image : \"".$image_background."\" , title : 'Restaurant Esprit du 12eme'}, "; ?>
																<?php echo $slider; ?>		
															<?php } // End of foreach Loop?>
															{image : 'http://www.lespritdu12eme.com/wp-content/uploads/2014/02/bg-home.jpg', title : 'Restaurant Esprit du 12eme'}
											],
											
				// Theme Options			   
				progress_bar			:	1,			// Timer for each slide							
				mouse_scrub				:	0
				
			});
	    });
	    
	</script>
<?php get_footer(); ?>
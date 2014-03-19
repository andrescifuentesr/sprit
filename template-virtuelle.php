<?php
/*
Template Name: Visite Virtuelle
*/

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main visite-virtuelle" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; // end of the loop. ?>
			
			<!--Control Bar-->
			<div id="controls-wrapper" class="load-item">
				<div id="controls">
					
					<?php $icl_object_id = icl_object_id('11', 'page', true); ?>

					<div class="button-photos clearfix">
						<a href="<?php echo esc_url( get_permalink($icl_object_id) ); ?>" class="button">REVENIR AUX PHOTOS</a>					
					</div>

				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
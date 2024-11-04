<?php if ( has_post_thumbnail() ) : ?>
	<div class="qodef-e-media-image">
		<?php the_post_thumbnail( 'full' ); ?>
		<div class="qodef-e-media-icon">
			<?php halstein_render_svg_icon( 'play' ); ?>
		</div>
		<a itemprop="url" href="<?php the_permalink(); ?>"></a>
		<?php
		// Hook to include additional content after blog post featured image
		do_action( 'halstein_action_after_post_thumbnail_image' );
		?>
	</div>
<?php endif; ?>

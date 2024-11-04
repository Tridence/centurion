<?php
$gallery_meta = get_post_meta( get_the_ID(), 'qodef_post_format_gallery_images', true );
?>

<?php if ( ! empty( $gallery_meta ) ) : ?>
	<div class="qodef-e-media-gallery qodef-swiper-container">
		<div class="swiper-wrapper">
			<?php
			$gallery_images = explode( ',', $gallery_meta );
			?>

			<?php foreach ( $gallery_images as $image_id ) : ?>
				<div class="qodef-e-media-gallery-item swiper-slide">
					<?php if ( ! is_single() ) : ?>
					<a itemprop="url" href="<?php the_permalink(); ?>">
						<?php endif; ?>
						<?php echo wp_get_attachment_image( $image_id, 'full' ); ?>
						<?php if ( ! is_single() ) : ?>
					</a>
				<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="swiper-button-prev"><?php halstein_render_svg_icon( 'slider-arrow-left' ); ?></div>
		<div class="swiper-button-next"><?php halstein_render_svg_icon( 'slider-arrow-right' ); ?></div>
	</div>
<?php else : ?>
	<?php
	// Include featured image
	halstein_template_part( 'blog', 'templates/parts/post-info/image' );
	?>
<?php endif; ?>

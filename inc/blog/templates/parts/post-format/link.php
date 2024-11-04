<?php
$link_url_meta  = get_post_meta( get_the_ID(), 'qodef_post_format_link', true );
$link_url       = ! empty( $link_url_meta ) ? $link_url_meta : get_the_permalink();
$link_text_meta = get_post_meta( get_the_ID(), 'qodef_post_format_link_text', true );
?>

<?php if ( ! empty( $link_url ) ) : ?>
	<?php
	$link_text = ! empty( $link_text_meta ) ? $link_text_meta : get_the_title();
	$title_tag = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h4';
	?>
	<div class="qodef-e-link">
		<?php halstein_render_svg_icon( 'link', 'qodef-e-link-icon' ); ?>
		<?php echo '<' . esc_attr( $title_tag ); ?> class="qodef-e-link-text">
		<?php echo wp_kses_post( $link_text ); ?>
		<?php echo '</' . esc_attr( $title_tag ); ?>>
		<a itemprop="url" class="qodef-e-link-url" href="<?php echo esc_url( $link_url ); ?>" target="_blank"></a>
	</div>
<?php endif; ?>

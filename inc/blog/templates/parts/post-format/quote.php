<?php
$quote_meta = get_post_meta( get_the_ID(), 'qodef_post_format_quote_text', true );
$quote_text = ! empty( $quote_meta ) ? $quote_meta : get_the_title();
?>

<?php if ( ! empty( $quote_text ) ) : ?>
	<?php
	$quote_author     = get_post_meta( get_the_ID(), 'qodef_post_format_quote_author', true );
	$title_tag        = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h4';
	$author_title_tag = isset( $author_title_tag ) && ! empty( $author_title_tag ) ? $author_title_tag : 'span';
	?>
	<div class="qodef-e-quote">
		<?php halstein_render_svg_icon( 'quote', 'qodef-e-quote-icon' ); ?>
		<?php echo '<' . esc_attr( $title_tag ); ?> class="qodef-e-quote-text">
		<?php echo wp_kses_post( $quote_text ); ?>
		<?php echo '</' . esc_attr( $title_tag ); ?>>
		<?php if ( ! empty( $quote_author ) ) : ?>
			<?php echo '<' . esc_attr( $author_title_tag ); ?> class="qodef-e-quote-author">
			<?php echo esc_html( $quote_author ); ?>
			<?php echo '</' . esc_attr( $author_title_tag ); ?>>
		<?php endif; ?>
		<?php if ( ! is_single() ) : ?>
			<a itemprop="url" class="qodef-e-quote-url" href="<?php the_permalink(); ?>"></a>
		<?php endif; ?>
	</div>
<?php endif; ?>

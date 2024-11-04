<div id="qodef-404-page">
	<?php if ( ! empty( $tagline ) ) : ?>
		<h6 class="qodef-404-tagline"><?php echo esc_html( $tagline ); ?></h6>
	<?php endif; ?>
	<?php if ( ! empty( $title ) ) : ?>
		<h1 class="qodef-404-title"><?php echo esc_html( $title ); ?></h1>
	<?php endif; ?>
	<?php if ( ! empty( $text ) ) : ?>
		<p class="qodef-404-text"><?php echo esc_html( $text ); ?></p>
	<?php endif; ?>
	<?php if ( ! empty( $button_text ) ) : ?>
		<div class="qodef-404-button">
			<?php
			$button_params = array(
				'link'          => esc_url( home_url( '/' ) ),
				'text'          => esc_html( $button_text ),
				'button_layout' => 'filled-two',
			);

			halstein_render_button_element( $button_params );
			?>
		</div>
	<?php endif; ?>
</div>

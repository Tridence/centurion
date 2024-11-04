<div id="qodef-page-comments">
	<?php if ( have_comments() ) : ?>
		<?php
		$comments_number = get_comments_number();
		?>
		<div id="qodef-page-comments-list" class="qodef-m">
			<?php // translators: %s - number of comments value ?>
			<h3 class="qodef-m-title"><?php echo esc_html( sprintf( _n( '%s Comment', '%s Comments', intval( $comments_number ), 'halstein' ), intval( $comments_number ) ) ); ?></h3>
			<ul class="qodef-m-comments">
				<?php wp_list_comments( array_unique( array_merge( array( 'callback' => 'halstein_get_comments_list_template' ), apply_filters( 'halstein_filter_comments_list_template_callback', array() ) ) ) ); ?>
			</ul>
			<?php if ( get_comment_pages_count() > 1 ) : ?>
				<div class="qodef-m-pagination qodef--wp">
					<?php
					the_comments_pagination(
						array(
							'prev_text'          => halstein_get_svg_icon( 'pagination-arrow-left' ),
							'next_text'          => halstein_get_svg_icon( 'pagination-arrow-right' ),
							'before_page_number' => '0',
						)
					);
					?>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="qodef-page-comments-not-found"><?php esc_html_e( 'Comments are closed.', 'halstein' ); ?></p>
	<?php endif; ?>
	<div id="qodef-page-comments-form">
		<?php comment_form( halstein_get_comment_form_args() ); ?>
	</div>
</div>

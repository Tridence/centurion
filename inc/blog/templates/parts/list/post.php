<article <?php post_class( 'qodef-blog-item qodef-e' ); ?>>
	<div class="qodef-e-inner">
		<?php
		// Include post media
		halstein_template_part( 'blog', 'templates/parts/post-info/media' );
		?>
		<div class="qodef-e-content">
			<div class="qodef-e-top-holder">
				<div class="qodef-e-info">
					<?php
					// Include post date info
					halstein_template_part( 'blog', 'templates/parts/post-info/date' );

					// Include post author info
					halstein_template_part( 'blog', 'templates/parts/post-info/author' );

					// Include post category info
					halstein_template_part( 'blog', 'templates/parts/post-info/categories' );
					?>
				</div>
			</div>
			<div class="qodef-e-text">
				<?php
				// Include post title
				halstein_template_part( 'blog', 'templates/parts/post-info/title', '', array( 'title_tag' => 'h2' ) );

				// Include post excerpt
				halstein_template_part( 'blog', 'templates/parts/post-info/excerpt' );

				// Hook to include additional content after blog single content
				do_action( 'halstein_action_after_blog_single_content' );
				?>
			</div>
			<div class="qodef-e-bottom-holder">
				<div class="qodef-e-left">
					<?php
					// Include post read more
					halstein_template_part( 'blog', 'templates/parts/post-info/read-more' );
					?>
				</div>
				<?php if ( halstein_is_installed( 'core' ) ) : ?>
					<div class="qodef-e-right qodef-e-info">
						<?php
						// Include post social share info
						halstein_template_part( 'blog', 'templates/parts/post-info/social-share' );
						?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</article>

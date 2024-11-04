<?php if ( isset( $query_result ) && intval( $query_result->max_num_pages ) > 1 ) : ?>
	<div class="qodef-m-pagination qodef--simple">
		<nav class="qodef-m-pagination-items" role="navigation">
			<div class="qodef-m-pagination-item qodef--prev">
				<a href="#" data-paged="1">
					<?php halstein_render_svg_icon( 'pagination-arrow-left' ); ?>
					<span class="qodef-m-pagination-label">Prev Post</span>
				</a>
			</div>
			<div class="qodef-m-pagination-item qodef--next">
				<a href="#" data-paged="2">
					<span class="qodef-m-pagination-label">Next Post</span>
					<?php halstein_render_svg_icon( 'pagination-arrow-right' ); ?>
				</a>
			</div>
		</nav>
	</div>
<?php endif; ?>

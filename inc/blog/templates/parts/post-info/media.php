<div class="qodef-e-media">
	<?php
	switch ( get_post_format() ) {
		case 'gallery':
			halstein_template_part( 'blog', 'templates/parts/post-format/gallery' );
			break;
		case 'video':
			halstein_template_part( 'blog', 'templates/parts/post-format/video' );
			break;
		case 'audio':
			halstein_template_part( 'blog', 'templates/parts/post-format/audio' );
			break;
		default:
			halstein_template_part( 'blog', 'templates/parts/post-info/image' );
			break;
	}
	?>
</div>

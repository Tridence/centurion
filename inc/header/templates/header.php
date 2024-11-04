<?php
// Hook to include additional content before page header
do_action( 'halstein_action_before_page_header' );
?>
<header id="qodef-page-header" <?php halstein_class_attribute( apply_filters( 'halstein_filter_header_class', array() ) ); ?> role="banner">
	<?php
	// Hook to include additional content before page header inner
	do_action( 'halstein_action_before_page_header_inner' );
	?>
	<div id="qodef-page-header-inner" <?php halstein_class_attribute( apply_filters( 'halstein_filter_header_inner_class', array(), 'default' ) ); ?>>
		<?php
		// Include module content template
		echo apply_filters( 'halstein_filter_header_content_template', halstein_get_template_part( 'header', 'templates/header-content' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		?>
	</div>
	<?php
	// Hook to include additional content after page header inner
	do_action( 'halstein_action_after_page_header_inner' );
	?>
</header>

<?php

if ( ! function_exists( 'halstein_load_page_mobile_header' ) ) {
	/**
	 * Function which loads page template module
	 */
	function halstein_load_page_mobile_header() {
		// Include mobile header template
		echo apply_filters( 'halstein_filter_mobile_header_template', halstein_get_template_part( 'mobile-header', 'templates/mobile-header' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	add_action( 'halstein_action_page_header_template', 'halstein_load_page_mobile_header' );
}

if ( ! function_exists( 'halstein_register_mobile_navigation_menus' ) ) {
	/**
	 * Function which registers navigation menus
	 */
	function halstein_register_mobile_navigation_menus() {
		$navigation_menus = apply_filters( 'halstein_filter_register_mobile_navigation_menus', array( 'mobile-navigation' => esc_html__( 'Mobile Navigation', 'halstein' ) ) );

		if ( ! empty( $navigation_menus ) ) {
			register_nav_menus( $navigation_menus );
		}
	}

	add_action( 'halstein_action_after_include_modules', 'halstein_register_mobile_navigation_menus' );
}

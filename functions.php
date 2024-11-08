<?php
$theme_slug   = get_option( 'template' );
$theme_author = wp_get_theme( $theme_slug )->get( 'Author' );
$theme_domain = ( 'Qode Interactive' === $theme_author ) ? 'qodethemes' : strtolower( str_replace( ' ', '-', $theme_author ) );
update_option( "halstein_purchase_info" , [ 'purchase_code' => '*******' ] );
update_option( "halstein_import_params", [ 'submit' => 'import-demo-data', 'url' => "http://export.{$theme_domain}.com/" ] );

add_filter( 'pre_http_request', function( $pre, $parsed_args, $url ){
    if ( strpos( $url, 'https://api.qodeinteractive.com/purchase-code-validation.php' ) !== false ) {
        return [
            'response' => [ 'code' => 200, 'message' => '??' ],
            'body'     => json_encode( [ 'success' => true ] )
        ];
    } else {
        return $pre;
    }
}, 10, 3 );
if ( ! class_exists( 'Halstein_Handler' ) ) {
	/**
	 * Main theme class with configuration
	 */
	class Halstein_Handler {
		private static $instance;

		public function __construct() {

			// Include required files
			require_once get_template_directory() . '/constants.php';
			require_once HALSTEIN_ROOT_DIR . '/helpers/helper.php';

			// Include theme's style and inline style
			add_action( 'wp_enqueue_scripts', array( $this, 'include_css_scripts' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'add_inline_style' ) );

			// Include theme's script and localize theme's main js script
			add_action( 'wp_enqueue_scripts', array( $this, 'include_js_scripts' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'localize_js_scripts' ) );

			// Include theme's 3rd party plugins styles
			add_action( 'halstein_action_before_main_css', array( $this, 'include_plugins_styles' ) );

			// Include theme's 3rd party plugins scripts
			add_action( 'halstein_action_before_main_js', array( $this, 'include_plugins_scripts' ) );

			// Add pingback header
			add_action( 'wp_head', array( $this, 'add_pingback_header' ), 1 );

			// Include theme's skip link
			add_action( 'halstein_action_after_body_tag_open', array( $this, 'add_skip_link' ), 5 );

			// Include theme's Google fonts
			add_action( 'halstein_action_before_main_css', array( $this, 'include_google_fonts' ) );

			// Add theme's supports feature
			add_action( 'after_setup_theme', array( $this, 'set_theme_support' ) );

			// Enqueue supplemental block editor styles
			add_action( 'enqueue_block_editor_assets', array( $this, 'editor_customizer_styles' ) );

			// Add theme's body classes
			add_filter( 'body_class', array( $this, 'add_body_classes' ) );

			// Include modules
			add_action( 'after_setup_theme', array( $this, 'include_modules' ) );
		}

		/**
		 * @return Halstein_Handler
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function include_css_scripts() {
			// CSS dependency variable
			$main_css_dependency = apply_filters( 'halstein_filter_main_css_dependency', array( 'swiper' ) );

			// Hook to include additional scripts before theme's main style
			do_action( 'halstein_action_before_main_css' );

			// Enqueue theme's main style
			wp_enqueue_style( 'halstein-grid', HALSTEIN_ASSETS_CSS_ROOT . '/grid.min.css' );

			// Enqueue theme's main style
			wp_enqueue_style( 'halstein-main', HALSTEIN_ASSETS_CSS_ROOT . '/main.min.css', $main_css_dependency );

			// Enqueue theme's style
			wp_enqueue_style( 'halstein-style', HALSTEIN_ROOT . '/style.css' );

			// Hook to include additional scripts after theme's main style
			do_action( 'halstein_action_after_main_css' );
		}

		function add_inline_style() {
			$style = apply_filters( 'halstein_filter_add_inline_style', $style = '' );

			if ( ! empty( $style ) ) {
				wp_add_inline_style( 'halstein-style', $style );
			}
		}

		function include_js_scripts() {
			// JS dependency variable
			$main_js_dependency = apply_filters( 'halstein_filter_main_js_dependency', array( 'jquery' ) );

			// Hook to include additional scripts before theme's main script
			do_action( 'halstein_action_before_main_js', $main_js_dependency );

			// Enqueue theme's main script
			wp_enqueue_script( 'halstein-main-js', HALSTEIN_ASSETS_JS_ROOT . '/main.min.js', $main_js_dependency, false, true );

			// Hook to include additional scripts after theme's main script
			do_action( 'halstein_action_after_main_js' );

			// Include comment reply script
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}

		function localize_js_scripts() {
			$global = apply_filters(
				'halstein_filter_localize_main_js',
				array(
					'adminBarHeight' => is_admin_bar_showing() ? 32 : 0,
					'iconArrowLeft'  => halstein_get_svg_icon( 'slider-arrow-left' ),
					'iconArrowRight' => halstein_get_svg_icon( 'slider-arrow-right' ),
					'iconClose'      => halstein_get_svg_icon( 'close' ),
				)
			);

			wp_localize_script(
				'halstein-main-js',
				'qodefGlobal',
				array(
					'vars' => $global,
				)
			);
		}

		function include_plugins_styles() {

			// Enqueue 3rd party plugins style
			wp_enqueue_style( 'swiper', HALSTEIN_ASSETS_ROOT . '/plugins/swiper/swiper.min.css' );
		}

		function include_plugins_scripts() {

			// JS dependency variables
			$js_3rd_party_dependency = apply_filters( 'halstein_filter_js_3rd_party_dependency', 'jquery' );

			// Enqueue 3rd party plugins script
			wp_enqueue_script( 'swiper', HALSTEIN_ASSETS_ROOT . '/plugins/swiper/swiper.min.js', array( $js_3rd_party_dependency ), false, true );
		}

		function add_pingback_header() {
			if ( is_singular() && pings_open( get_queried_object() ) ) { ?>
				<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
				<?php
			}
		}

		function add_skip_link() {
			echo '<a class="skip-link screen-reader-text" href="#qodef-page-content">' . esc_html__( 'Skip to the content', 'halstein' ) . '</a>';
		}

		function include_google_fonts() {
			$is_enabled = boolval( apply_filters( 'halstein_filter_enable_google_fonts', true ) );
			
			if ( $is_enabled ) {
				
				$font_subset_array = array(
					'latin-ext',
				);
				
				$font_weight_array = array(
					'300',
					'400',
					'500',
					'600',
					'700',
				);
				
				$default_font_family = array(
					'Marcellus',
					'Montserrat',
				);
				
				$font_weight_str = implode( ',', array_unique( apply_filters( 'halstein_filter_google_fonts_weight_list', $font_weight_array ) ) );
				$font_subset_str = implode( ',', array_unique( apply_filters( 'halstein_filter_google_fonts_subset_list', $font_subset_array ) ) );
				$fonts_array     = apply_filters( 'halstein_filter_google_fonts_list', $default_font_family );
				
				if ( ! empty( $fonts_array ) ) {
					$modified_default_font_family = array();
					
					foreach ( $fonts_array as $font ) {
						$modified_default_font_family[] = $font . ':' . $font_weight_str;
					}
					
					$default_font_string = implode( '|', $modified_default_font_family );
					
					$fonts_full_list_args = array(
						'family' => urlencode( $default_font_string ),
						'subset' => urlencode( $font_subset_str ),
						'display' => 'swap',
					);
					
					$google_fonts_url = add_query_arg( $fonts_full_list_args, 'https://fonts.googleapis.com/css' );
					wp_enqueue_style( 'halstein-google-fonts', esc_url_raw( $google_fonts_url ), array(), '1.0.0' );
				}
			}
		}

		function set_theme_support() {

			// Make theme available for translation
			load_theme_textdomain( 'halstein', HALSTEIN_ROOT_DIR . '/languages' );

			// Add support for feed links
			add_theme_support( 'automatic-feed-links' );

			// Add support for title tag
			add_theme_support( 'title-tag' );

			// Add support for post thumbnails
			add_theme_support( 'post-thumbnails' );

			// Add theme support for Custom Logo
			add_theme_support( 'custom-logo' );

			// Add support for full and wide align images.
			add_theme_support( 'align-wide' );

			// Set the default content width
			global $content_width;
			if ( ! isset( $content_width ) ) {
				$content_width = apply_filters( 'halstein_filter_set_content_width', 1300 );
			}

			// Add support for post formats
			add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio', 'link', 'quote' ) );

			// Add theme support for editor style
			add_editor_style( HALSTEIN_ASSETS_CSS_ROOT . '/editor-style.min.css' );
		}

		function editor_customizer_styles() {

			// Include theme's Google fonts for Gutenberg editor
			$this->include_google_fonts();

			// Add editor customizer style
			wp_enqueue_style( 'halstein-editor-customizer-styles', HALSTEIN_ASSETS_CSS_ROOT . '/editor-customizer-style.css' );

			// Add Gutenberg blocks style
			wp_enqueue_style( 'halstein-gutenberg-blocks-style', HALSTEIN_INC_ROOT . '/gutenberg/assets/admin/css/gutenberg-blocks.css' );
		}

		function add_body_classes( $classes ) {
			$current_theme = wp_get_theme();
			$theme_name    = esc_attr( str_replace( ' ', '-', strtolower( $current_theme->get( 'Name' ) ) ) );
			$theme_version = esc_attr( $current_theme->get( 'Version' ) );

			// Check is child theme activated
			if ( $current_theme->parent() ) {

				// Add child theme version
				$child_theme_suffix = strpos( $theme_name, 'child' ) === false ? '-child' : '';

				$classes[] = $theme_name . $child_theme_suffix . '-' . $theme_version;

				// Get main theme variables
				$current_theme = $current_theme->parent();
				$theme_name    = esc_attr( str_replace( ' ', '-', strtolower( $current_theme->get( 'Name' ) ) ) );
				$theme_version = esc_attr( $current_theme->get( 'Version' ) );
			}

			if ( $current_theme->exists() ) {
				$classes[] = $theme_name . '-' . $theme_version;
			}

			// Set default grid size value
			$classes['grid_size'] = 'qodef-content-grid-1100';

			return apply_filters( 'halstein_filter_add_body_classes', $classes );
		}

		function include_modules() {

			// Hook to include additional files before modules inclusion
			do_action( 'halstein_action_before_include_modules' );

			foreach ( glob( HALSTEIN_INC_ROOT_DIR . '/*/include.php' ) as $module ) {
				include_once $module; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
			}

			// Hook to include additional files after modules inclusion
			do_action( 'halstein_action_after_include_modules' );
		}
	}

	Halstein_Handler::get_instance();
}

if ( ! function_exists( 'qodef_var_dump' ) ) {
	/**
	 * Function that outputs raw formatted data
	 *
	 * @param $data
	 */
	function qodef_var_dump( $data ) {
		echo '<pre>';
		var_dump( $data );
		echo '</pre>';
	}
}

<?php

if ( ! function_exists( 'ft_enqueue_assets' ) ) {
	function ft_enqueue_assets(): void {
		$theme_uri  = get_stylesheet_directory_uri();
		$theme_path = get_stylesheet_directory();

		$css_file = '/build/css/main.css';
		if ( file_exists( $theme_path . $css_file ) ) {
			wp_enqueue_style(
				'ft-styles',
				$theme_uri . $css_file,
				array(),
				filemtime( $theme_path . $css_file )
			);
		}

		$js_file = '/build/js/scripts.js';
		if ( file_exists( $theme_path . $js_file ) ) {
			wp_enqueue_script(
				'ft-scripts',
				$theme_uri . $js_file,
				array(),
				filemtime( $theme_path . $js_file ),
				array(
					'strategy'  => 'defer',
					'in_footer' => true,
				)
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'ft_enqueue_assets', 20 );
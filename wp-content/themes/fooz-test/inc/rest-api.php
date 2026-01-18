<?php

if ( ! function_exists( 'ft_register_custom_book_fields' ) ) {
	function ft_register_custom_book_fields(): void {
		$args = array(
			'get_callback' => function ( $post_array ) {
				return get_the_date( get_option( 'date_format' ), $post_array['id'] );
			},
			'schema'       => null,
		);
		register_rest_field( 'book', 'formatted_date', $args );
	}
}
add_action( 'rest_api_init', 'ft_register_custom_book_fields' );
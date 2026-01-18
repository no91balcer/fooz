<?php

if ( ! function_exists( 'ft_register_blocks' ) ) {
	function ft_register_blocks(): void {
		register_block_type( get_stylesheet_directory() . '/build/blocks/book-related' );
	}
}
add_action( 'init', 'ft_register_blocks' );
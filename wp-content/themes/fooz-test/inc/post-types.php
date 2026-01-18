<?php

require_once get_theme_file_path( '/inc/classes/class-custom-post-type.php' );
require_once get_theme_file_path( '/inc/classes/class-custom-taxonomy.php' );

if ( ! function_exists( 'ft_register_custom_post_types_and_taxonomies' ) ) {
	function ft_register_custom_post_types_and_taxonomies(): void {
		$books = new Custom_Post_Type(
			'book',
			array(
				'name'                     => _x( 'Books', 'General Name', 'fooz-test' ),
				'singular_name'            => _x( 'Book', 'Singular Name', 'fooz-test' ),
				'add_new'                  => __( 'Add a book', 'fooz-test' ),
				'add_new_item'             => __( 'Add a book', 'fooz-test' ),
				'edit_item'                => __( 'Edit book', 'fooz-test' ),
				'new_item'                 => __( 'New book', 'fooz-test' ),
				'view_item'                => __( 'View a book', 'fooz-test' ),
				'view_items'               => __( 'View books', 'fooz-test' ),
				'search_items'             => __( 'Search books', 'fooz-test' ),
				'not_found'                => __( 'No books found', 'fooz-test' ),
				'not_found_in_trash'       => __( 'No books found in Trash', 'fooz-test' ),
				'all_items'                => __( 'All books', 'fooz-test' ),
				'archives'                 => __( 'Book archives', 'fooz-test' ),
				'attributes'               => __( 'Book attributes', 'fooz-test' ),
				'insert_into_item'         => __( 'Put in the book', 'fooz-test' ),
				'uploaded_to_this_item'    => __( 'Uploaded to this book', 'fooz-test' ),
				'filter_items_list'        => __( 'Filter books list', 'fooz-test' ),
				'items_list_navigation'    => __( 'Books list navigation', 'fooz-test' ),
				'items_list'               => __( 'Books list', 'fooz-test' ),
				'item_published'           => __( 'Book published', 'fooz-test' ),
				'item_published_privately' => __( 'Book published privately', 'fooz-test' ),
				'item_reverted_to_draft'   => __( 'Book reverted to draft.', 'fooz-test' ),
				'item_trashed'             => __( 'Book trashed.', 'fooz-test' ),
				'item_scheduled'           => __( 'Book scheduled.', 'fooz-test' ),
				'item_updated'             => __( 'Book updated.', 'fooz-test' ),
				'item_link'                => __( 'Book Link', 'fooz-test' ),
				'item_link_description'    => __( 'A link to the post.', 'fooz-test' ),
			),
			true,
			'dashicons-book-alt'
		);
		$books->set_rewrite( 'library' );
		$books->register();

		$genres = new Custom_Taxonomy(
			'genre',
			$books,
			array(
				'name'                     => _x( 'Genres', 'General Name', 'fooz-test' ),
				'singular_name'            => _x( 'Genre', 'Singular Name', 'fooz-test' ),
				'search_items'             => __( 'Search genres', 'fooz-test' ),
				'all_items'                => __( 'All genres', 'fooz-test' ),
				'parent_item'              => __( 'Parent genre', 'fooz-test' ),
				'parent_field_description' => __( 'Assign a parent genre to create a hierarchy', 'fooz-test' ),
				'edit_item'                => __( 'Edit genre', 'fooz-test' ),
				'view_item'                => __( 'View genre', 'fooz-test' ),
				'update_item'              => __( 'Update genre', 'fooz-test' ),
				'add_new_item'             => __( 'Add a genre', 'fooz-test' ),
				'new_item_name'            => __( 'New genre name', 'fooz-test' ),
				'template_name'            => __( 'Genre archives', 'fooz-test' ),
				'not_found'                => __( 'No genres found', 'fooz-test' ),
				'no_terms'                 => __( 'No genres', 'fooz-test' ),
				'filter_by_item'           => __( 'Filter by genre', 'fooz-test' ),
				'item_link'                => __( 'Genre link', 'fooz-test' ),
				'item_link_description'    => __( 'A link to a genre', 'fooz-test' ),
			),
			true
		);
		$genres->set_rewrite( 'book-genre' );
		$genres->register();
	}
}
add_action( 'init', 'ft_register_custom_post_types_and_taxonomies', 5 );
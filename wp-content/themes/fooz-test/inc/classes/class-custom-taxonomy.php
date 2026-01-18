<?php

use traits\Capability_Manager;

require_once get_theme_file_path( '/inc/traits/trait-capability-manager.php' );

class Custom_Taxonomy {
	use Capability_Manager;

	private string $name;
	private Custom_Post_Type $post_type;
	private array $args;

	public function __construct( string $name, Custom_Post_Type $post_type, array $labels = array(), bool $custom_caps = false ) {
		$this->name      = $name;
		$this->post_type = $post_type;
		$this->args      = array(
			'public'            => true,
			'hierarchical'      => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
		);

		if ( count( $labels ) > 0 ) {
			$this->args['labels'] = $labels;
		}

		if ( $custom_caps ) {
			$this->build_capabilities();
		}
	}

	private function build_capabilities(): void {
		$caps = [
			'manage_terms' => "manage_{$this->name}",
			'edit_terms'   => "edit_{$this->name}",
			'delete_terms' => "delete_{$this->name}",
			'assign_terms' => "assign_{$this->name}"
		];
		$this->register_capabilities_logic( $caps, $this->args );
	}

	public function register(): void {
		add_action( 'init', array( $this, 'register_taxonomy' ) );
		add_action( 'restrict_manage_posts', array( $this, 'add_filter_dropdown' ) );
		add_filter( 'parse_query', array( $this, 'filter_by_taxonomy' ) );
	}

	public function add_filter_dropdown(): void {
		global $wp_query;

		$screen = get_current_screen();

		if ( $screen && $screen->post_type === $this->post_type->get_name() ) {
			$tax_count = wp_count_terms( $this->name, array( 'hide_empty' => true ) );

			if ( $tax_count > 0 ) {
				$labels = get_taxonomy_labels( get_taxonomy( $this->name ) );

				wp_dropdown_categories(
					array(
						'show_option_all' => $labels->all_items,
						'taxonomy'        => $this->name,
						'name'            => $this->name,
						'orderby'         => 'name',
						'selected'        => isset( $wp_query->query[ $this->name ] ) ?: '',
						'hierarchical'    => false,
						'depth'           => 3,
						'show_count'      => false,
						'hide_empty'      => true,
					)
				);
			}
		}
	}

	public function filter_by_taxonomy( WP_Query $query ): void {
		$query_vars = &$query->query_vars;

		if ( isset( $query_vars[ $this->name ] ) && is_numeric( $query_vars[ $this->name ] ) ) {
			$term = get_term_by( 'id', $query_vars[ $this->name ], $this->name );

			$query_vars[ $this->name ] = $term->slug;
		}
	}

	public function set_rewrite( string $slug ): void {
		$this->args['rewrite'] = [ 'slug' => $slug ];
	}

	public function register_taxonomy(): void {
		register_taxonomy( $this->name, $this->post_type->get_name(), $this->args );
	}

	public function get_name(): string {
		return $this->name;
	}
}
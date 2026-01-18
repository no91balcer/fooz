<?php

use traits\Capability_Manager;

require_once get_theme_file_path( '/inc/traits/trait-capability-manager.php' );

class Custom_Post_Type {
	use Capability_Manager;

	private string $name;
	private array $args;

	public function __construct( string $name, array $labels = array(), bool $custom_caps = false, string $marker = 'dashicons-marker' ) {
		$this->name = $name;
		$this->args = [
			'labels'       => $labels,
			'public'       => true,
			'show_in_rest' => true,
			'menu_icon'    => $marker,
			'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'has_archive'  => true,
		];

		if ( $custom_caps ) {
			$this->build_capabilities();
		}
	}

	private function build_capabilities(): void {
		$caps = [
			'edit_post'              => "edit_{$this->name}_single",
			'read_post'              => "read_{$this->name}_single",
			'delete_post'            => "delete_{$this->name}_single",
			'edit_posts'             => "edit_{$this->name}",
			'edit_others_posts'      => "edit_others_{$this->name}",
			'publish_posts'          => "publish_{$this->name}",
			'read_private_posts'     => "read_private_{$this->name}",
			'delete_posts'           => "delete_{$this->name}",
			'delete_private_posts'   => "delete_private_{$this->name}",
			'delete_published_posts' => "delete_published_{$this->name}",
			'delete_others_posts'    => "delete_others_{$this->name}",
			'edit_private_posts'     => "edit_private_{$this->name}",
			'edit_published_posts'   => "edit_published_{$this->name}",
			'create_posts'           => "edit_{$this->name}",
		];

		$this->args['map_meta_cap']    = true;
		$this->args['capability_type'] = array( "{$this->name}_single", $this->name );
		$this->register_capabilities_logic( $caps, $this->args );
	}

	public function set_rewrite( string $slug ): void {
		$this->args['rewrite'] = array( 'slug' => $slug );
	}

	public function register(): void {
		register_post_type( $this->name, $this->args );
	}

	public function get_name(): string {
		return $this->name;
	}
}

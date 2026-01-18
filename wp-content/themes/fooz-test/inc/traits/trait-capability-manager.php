<?php

namespace traits;

trait Capability_Manager {
	protected function register_capabilities_logic( array $caps, array &$args ): void {
		$args['capabilities'] = $caps;

		if ( is_admin() ) {
			$role = get_role( 'administrator' );
			if ( ! $role ) {
				return;
			}

			$first_cap = reset( $caps );
			if ( ! $role->has_cap( $first_cap ) ) {
				foreach ( $caps as $cap ) {
					$role->add_cap( $cap );
				}
			}
		}
	}
}
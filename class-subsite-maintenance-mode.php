<?php declare( strict_types = 1 );

if ( class_exists( 'Index_Me_Rest' ) ) {
	return;
}

class Subsite_Maintenance {

	private $table;

	/**
	 * Constructor.
	 *
	 * @param \WP_List_Table_Custom_Column_Toggle $table
	 */
	private function __construct( \WP_List_Table_Custom_Column_Toggle $table ) {
		$this->table = $table;
		$this->init();
	}

	/**
	 * Static factory.
	 *
	 * @link https://carlalexander.ca/static-factory-method-pattern-wordpress/
	 *
	 * @param \WP_List_Table_Custom_Column_Toggle $table
	 * @return \Index_Me_Rest
	 */
	public static function create( \WP_List_Table_Custom_Column_Toggle $table ) {
		return new self( $table );
	}

	/**
	 * Add action that checks if a subsite is in maintanance mode.
	 *
	 * @return void
	 */
	public function init() {
		add_action(
			'init',
			function () {
				$subsites_in_maintenance_mode = $this->table->get_values();
				$blog_id                      = get_current_blog_id();

				if ( is_admin() && in_array( $blog_id, $subsites_in_maintenance_mode ) && ! current_user_can( 'manage_network' ) && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
					wp_redirect( home_url() );
					exit;
				}
			}
		);
	}
}

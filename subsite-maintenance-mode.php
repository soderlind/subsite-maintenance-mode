<?php declare( strict_types = 1 );
/**
 * Set subsite in mainenancemode
 *
 * @package     Set subsite in mainenancemode
 * @author      Per Soderlind
 * @copyright   2020 Per Soderlind
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Set subsite in mainenancemode
 * Plugin URI: https://github.com/soderlind/subsite-maintenance-mode
 * GitHub Plugin URI: https://github.com/soderlind/subsite-maintenance-mode
 * Description: description
 * Version:     0.0.1
 * Author:      Per Soderlind
 * Author URI:  https://soderlind.no
 * Text Domain: subsite-maintenance-mode
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */


if ( ! defined( 'ABSPATH' ) ) {
	wp_die();
}

add_action( ‘init’, function () {

	$subsites_in_maintenance_mode = [
		2,3,4,5
	];

	$blog_id = get_current_blog_id();

	if ( is_admin() && isset( $subsites_in_maintenance_mode[ $blog_id ] ) && ! current_user_can( 'manage_network' ) && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		wp_redirect( home_url() );
		exit;
	}
} );
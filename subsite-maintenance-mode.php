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
 * Network: true
 */

namespace Soderlind\Plugin\Multisite;

if ( ! defined( 'ABSPATH' ) ) {
	wp_die();
}

require_once plugin_dir_path( __FILE__ ) . 'inc/class-wp-table-custom-column-toggle/class-wp-table-custom-column-toggle.php';
require_once plugin_dir_path( __FILE__ ) . 'class-subsite-maintenance-mode.php';


$subsite_maintenance_sites = \WP_Table_Custom_Column_Toggle::create(
	[
		'column_id'       => 'subsite_maintenance',
		'column_name'     => '<span class="dashicons dashicons-hammer"></span>',
		'column_hooks'    => [
			'header'  => 'wpmu_blogs_columns',
			'content' => 'manage_sites_custom_column',
		],
		'use_siteoptions' => true,
	]
);

$subsite_maintenance = \Subsite_Maintenance::create( $subsite_maintenance_sites );

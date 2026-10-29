<?php
/**
 * Plugin Name: Legacy Widgets in Block Editor
 * Plugin URI: https://status301.net/wordpress-plugins/restore-legacy-widgets/
 * Description: Make the Legacy Widget block available anywhere in the WordPress block editor.
 * Text Domain: restore-legacy-widgets
 * Version: 1.0.0
 * Requires at least: 5.8.0
 * Author: RavanH
 * Author URI: http://status301.net/
 *
 * @package Legacy Widgets in Block Editor
 */

defined( 'WPINC' ) || die;

add_action( 'admin_print_styles', function() {
    if ( get_current_screen()->is_block_editor() ) {
        do_action( 'admin_print_styles-widgets.php' );
    }
} );
add_action( 'admin_print_scripts', function() {
    if ( get_current_screen()->is_block_editor() ) {
        do_action( 'load-widgets.php' );
        do_action( 'widgets.php' );
        do_action( 'sidebar_admin_setup' );
        do_action( 'admin_print_scripts-widgets.php' );
    }
} );
add_action( 'admin_print_footer_scripts', function() {
    if ( get_current_screen()->is_block_editor() ) {
        do_action( 'admin_print_footer_scripts-widgets.php' );
    }
} );
add_action( 'admin_footer', function() {
    if ( get_current_screen()->is_block_editor() ) {
        do_action( 'admin_footer-widgets.php' );
    }
} );

add_action( 'enqueue_block_editor_assets', function() {
    wp_enqueue_script( 'wp-widgets' );
    wp_add_inline_script( 'wp-widgets', 'wp.widgets.registerLegacyWidgetBlock()' );
} );

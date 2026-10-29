<?php
/**
 * Plugin Name: Legacy Widgets in Block Editor
 * Plugin URI: https://status301.net/wordpress-plugins/legacy-widgets-in-block-editor/
 * Description: Make the Legacy Widget block available anywhere in the WordPress block editor.
 * Version: 1.0.0
 * Requires at least: 5.8.0
 * Author: RavanH
 * Author URI: http://status301.net/
 * License: GPLv2 or later
 *
 * @package Legacy Widgets in Block Editor
 */

defined( 'WPINC' ) || die;

/**
 * This plugin makes the Legacy Widget block available anywhere in the WordPress block editor.
 * All props go to the WordPress core team for creating the Legacy Widget block and for sharing the necessary code to allow the block in the block editor.
 *
 * The code in this plugin is a direct implementation of the following resource:
 * https://developer.wordpress.org/block-editor/how-to-guides/widgets/legacy-widget-block/#using-the-legacy-widget-block-in-other-block-editors-advanced
 */

/**
 * Load the necessary scripts and styles for the Legacy Widget block to work in the block editor.
 * This is done by hooking into the admin_print_styles, admin_print_scripts, admin_print_footer_scripts,
 * and admin_footer actions, and checking if the current screen is the block editor.
 * If it is, the necessary actions are triggered to load the scripts and styles for the Legacy Widget block.
 */

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

/**
 * Next, enqueue the script that registers the Legacy Widget block.
 * This script is included with WordPress core and is normally enqueued
 * only on the widgets WP Admin screen.
 */

add_action( 'enqueue_block_editor_assets', function() {
    wp_enqueue_script( 'wp-widgets' );
    wp_add_inline_script( 'wp-widgets', 'wp.widgets.registerLegacyWidgetBlock()' );
} );

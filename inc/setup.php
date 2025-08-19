<?php
// inc/setup.php

/**
 * Enqueue theme stylesheets
 *
 * Loads all css files
 * Uses filemtime() for cache-busting in development.
 */
function mytheme_enqueue_all_styles()
{
    $css_dir = get_template_directory() . '/assets/css/';
    $css_uri = get_template_directory_uri() . '/assets/css/';

    foreach (glob($css_dir . '*.css') as $file) {
        $handle = 'mytheme-' . basename($file, '.css'); // mytheme-global, mytheme-header, etc.
        wp_enqueue_style(
            $handle,
            $css_uri . basename($file),
            array(),
            filemtime($file)
        );
    }
    // Main css file
    wp_enqueue_style('mytheme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_all_styles');

/**
 * Register theme navigation menus
 *
 * Adds menu locations that can be assigned via the WordPress admin panel.
 */
function mytheme_register_menus()
{
    register_nav_menus(array(
        'header-menu' => __('Header Menu', 'mytheme'),
    ));
}
add_action('after_setup_theme', 'mytheme_register_menus');

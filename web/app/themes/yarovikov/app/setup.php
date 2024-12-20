<?php

declare(strict_types=1);

namespace App;

use function Roots\bundle;

// Assets
add_action('wp_enqueue_scripts', function () {
    wp_dequeue_style('global-styles');
    wp_dequeue_style('wp-block-library');

    bundle('app')->enqueue();
}, 100);

add_action('enqueue_block_editor_assets', function () {
    bundle('editor')->enqueue();
}, 100);

// Support some features
add_action('after_setup_theme', function () {
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
    ]);

    remove_theme_support('block-templates');
    remove_theme_support('core-block-patterns');

    // https://github.com/WordPress/gutenberg/issues/33576
    remove_filter('admin_head', 'wp_check_widget_editor_deps');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');
}, 20);

// Register sidebar
add_action('widgets_init', function (): void {
    register_sidebar(
        [
            'name' => 'Sidebar',
            'id' => 'post-sidebar',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '',
            'after_title' => '',
        ]
    );
});

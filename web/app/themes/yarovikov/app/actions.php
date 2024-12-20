<?php

declare(strict_types=1);

namespace App;

// Post meta register for rest. Here is not the best place
add_action('init', function (): void {
    // for pages
    register_post_meta('page', 'is_sidebar', [
        'show_in_rest' => true,
        'type' => 'boolean',
        'single' => true,
        'auth_callback' => function (): bool {
            return current_user_can('edit_posts');
        },
    ]);

    // for posts
    register_post_meta('post', 'is_featured', [
        'show_in_rest' => true,
        'type' => 'boolean',
        'single' => true,
        'auth_callback' => function (): bool {
            return current_user_can('edit_posts');
        },
    ]);
});

<?php

declare(strict_types=1);

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Page extends Composer
{
    protected static $views = [
        'partials.content-page',
    ];

    public function with()
    {
        $page_id = (int) get_the_ID();

        if (0 === $page_id) {
            return [];
        }

        return [
            'is_sidebar' => (bool) get_post_meta($page_id, 'is_sidebar', true),
        ];
    }
}

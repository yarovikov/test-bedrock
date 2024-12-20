<?php

declare(strict_types=1);

namespace App\View\Composers;

use App\Traits\PostData;
use Roots\Acorn\View\Composer;

class Post extends Composer
{
    use PostData;

    protected static $views = [
        'partials.content-single',
    ];

    public function with()
    {
        $post_id = (int) get_the_ID();

        if (0 === $post_id) {
            return [];
        }

        return [
            ...self::getPostData($post_id),
        ];
    }
}

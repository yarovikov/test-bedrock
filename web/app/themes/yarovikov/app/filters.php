<?php

declare(strict_types=1);

namespace App;

use stdClass;

/**
 * Pass blocks content from the widget area to gutengood absract block for checking and enqueue if isset
 * Based on https://github.com/WordPress/gutenberg/issues/44616
 */

add_filter('content_with_gutengood_blocks', function (string $content): string {
    // or based on page template, etc
    if (!is_page() || false === (bool) get_post_meta(get_the_ID(), 'is_sidebar', true)) {
        return $content;
    }

    $widgets = wp_get_sidebars_widgets();
    if (empty($widgets)) {
        return $content;
    }

    global $wp_widget_factory;
    $blocks_content = [];

    foreach ($widgets as $key => $value) {
        if ('post-sidebar' === $key) {
            if (isset($value) && is_array($value) && !empty($value)) {
                foreach ($value as $widget_id) {
                    $parsed_id = wp_parse_widget_id($widget_id);
                    $widget_object = $wp_widget_factory->get_widget_object($parsed_id['id_base']);
                    if ($widget_object && isset($parsed_id['number'])) {
                        $all_instances = $widget_object->get_settings();
                        if (!empty($all_instances)) {
                            $instance = $all_instances[$parsed_id['number']];
                            $serialized_instance = serialize($instance);
                            $prepared['instance']['encoded'] = base64_encode($serialized_instance);
                            $prepared['instance']['hash'] = wp_hash($serialized_instance);
                            if (!empty($widget_object->widget_options['show_instance_in_rest'])) {
                                $prepared['instance']['raw'] = empty($instance) ? new stdClass : $instance;
                                $blocks_content[] = $prepared['instance']['raw']['content'];
                            }
                        }
                    }
                }
            }
        }
    }
    if (empty($blocks_content)) {
        return $content;
    }

    return $content . implode('', $blocks_content);
});

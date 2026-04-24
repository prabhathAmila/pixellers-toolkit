<?php
if (!defined('ABSPATH'))
    exit;

class PT_CPT_Manager
{
    public function __construct()
    {
        add_action('init', [$this, 'register_pt_cpts']);
    }

    public function register_pt_cpts()
    {
        // Define our types: Headers/Footers are templates, others are public content
        $types = [
            'pt_header' => 'Headers',
            'pt_footer' => 'Footers',
            'pt_room' => 'Rooms',
            'pt_villa' => 'Villas',
            'pt_suite' => 'Suites'
        ];

        foreach ($types as $slug => $label) {
            // Determine if this is a template (not public) or a content page (public)
            $is_template = ($slug === 'pt_header' || $slug === 'pt_footer');

            register_post_type($slug, [
                'labels' => [
                    'name' => $label,
                    'singular_name' => rtrim($label, 's')
                ],
                'public' => true,
                'has_archive' => !$is_template, // Archives only for content, not templates
                'publicly_queryable' => !$is_template, // Disable public URLs for templates
                'show_in_menu' => 'edit.php?post_type=page', // You can change this to a custom menu slug
                'menu_icon' => $is_template ? 'dashicons-layout' : 'dashicons-admin-home',
                'supports' => [
                    'title',
                    'editor',
                    'elementor',
                    'thumbnail',
                    'excerpt'
                ],
                'show_in_rest' => true, // Required for Block Editor & Elementor stability
            ]);
        }
    }
}

// Instantiate safely
new PT_CPT_Manager();
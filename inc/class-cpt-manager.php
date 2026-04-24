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
        // Define our types
        $types = [
            'pt_header' => 'Headers',
            'pt_footer' => 'Footers',
            'pt_room' => 'Rooms'
        ];

        foreach ($types as $slug => $label) {
            register_post_type($slug, [
                'labels' => [
                    'name' => $label,
                    'singular_name' => rtrim($label, 's')
                ],
                'public' => true,
                'has_archive' => false,
                'publicly_queryable' => ($slug === 'pt_room'), // Rooms are public, Headers/Footers are templates
                'show_in_menu' => 'edit.php?post_type=page', // Or your custom menu
                'supports' => ['title', 'editor', 'elementor'],
                'show_in_rest' => true,
            ]);
        }
    }
}

// Instantiate safely
new PT_CPT_Manager();
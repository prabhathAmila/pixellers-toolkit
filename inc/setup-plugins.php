// In functions.php
require_once get_template_directory() . '/inc/setup-plugins.php';



<?php
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'pt_register_required_plugins');

function pt_register_required_plugins()
{
    $plugins = [
        // 1. Your Custom Plugin (Bundled in /plugins folder)
        [
            'name' => 'Pixellers Toolkit',
            'slug' => 'pixellers-toolkit',
            'source' => get_template_directory() . '/plugins/pixellers-toolkit.zip',
            'required' => true,
        ],
        // 2. Elementor (From Repository)
        [
            'name' => 'Elementor Website Builder',
            'slug' => 'elementor',
            'required' => true,
        ],
        // 3. Contact Form 7 (From Repository)
        [
            'name' => 'Contact Form 7',
            'slug' => 'contact-form-7',
            'required' => true,
        ],
    ];

    $config = [
        'id' => 'pixellers-theme',
        'menu' => 'tgmpa-install-plugins',
        'has_notices' => true,
        'dismissable' => false,
    ];

    tgmpa($plugins, $config);
}
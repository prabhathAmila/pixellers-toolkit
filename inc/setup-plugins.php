// In functions.php
require_once get_template_directory() . '/inc/setup-plugins.php';



<?php
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'pt_register_required_plugins');

function pt_register_required_plugins()
{
    $plugins = [
        [
            'name' => 'Pixellers Toolkit',
            'slug' => 'pixellers-toolkit',
            'source' => get_template_directory() . '/plugins/pixellers-toolkit.zip', // Path to your bundled plugin
            'required' => true,
            'force_activation' => true, // Optional: forces it to be active
        ],
    ];

    $config = [
        'id' => 'sahan-hotel',
        'menu' => 'tgmpa-install-plugins',
        'has_notices' => true,
        'dismissable' => false, // Forces user to install
    ];

    tgmpa($plugins, $config);
}
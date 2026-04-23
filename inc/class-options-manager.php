<?php
if (!defined('ABSPATH'))
    exit;

class PT_Options_Manager
{

    public function __construct()
    {
        add_action('admin_menu', [$this, 'setup_admin_menus']);
        add_action('admin_init', [$this, 'register_settings']);

        // Asset loading integrated directly into the class
        add_action('wp_enqueue_scripts', [$this, 'enqueue_plugin_styles']);
    }

    public function setup_admin_menus()
    {
        // 1. Parent Menu (The Dashboard)
        add_menu_page(
            'Pixellers Toolkit',
            'Pixellers',
            'manage_options',
            'pixellers-toolkit',
            [$this, 'render_dashboard'],
            'dashicons-admin-settings',
            30
        );

        // 2. Sub-menu: Settings (Default Landing Page)
        add_submenu_page(
            'pixellers-toolkit',
            'Theme Settings',
            'Theme Settings',
            'manage_options',
            'pixellers-toolkit',
            [$this, 'render_settings_page']
        );

        // 3. Sub-menu: License
        add_submenu_page(
            'pixellers-toolkit',
            'Theme License',
            'Theme License',
            'manage_options',
            'pt-license',
            [$this, 'render_license_page']
        );
    }

    public function register_settings()
    {
        register_setting('pt_settings_group', 'pt_brand_name');
        register_setting('pt_settings_group', 'pt_support_email');
    }

    // Asset Loading Logic
    public function enqueue_plugin_styles()
    {
        // Enqueue your style.css from assets/css/
        // Use dirname(__FILE__) to correctly path back to the plugin root
        wp_enqueue_style(
            'pixellers-toolkit-style',
            plugins_url('assets/css/style.css', dirname(dirname(__FILE__)) . '/pixellers-toolkit.php'),
            [],
            '1.0.0'
        );
    }

    public function render_dashboard()
    {
        echo '<div class="wrap"><h1>Pixellers Dashboard</h1><p>Welcome to the Pixellers Toolkit.</p></div>';
    }

    public function render_settings_page()
    {
        ?>
        <div class="wrap">
            <h1>Theme Settings</h1>
            <form method="post" action="options.php">
                <?php settings_fields('pt_settings_group');
                do_settings_sections('pt_settings_group'); ?>
                <table class="form-table">
                    <tr>
                        <th>Brand Name</th>
                        <td><input type="text" name="pt_brand_name"
                                value="<?php echo esc_attr(get_option('pt_brand_name')); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th>Support Email</th>
                        <td><input type="email" name="pt_support_email"
                                value="<?php echo esc_attr(get_option('pt_support_email')); ?>" class="regular-text"></td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

    public function render_license_page()
    {
        echo '<div class="wrap"><h1>Theme License</h1><p>License activation form goes here.</p></div>';
    }
}

new PT_Options_Manager();
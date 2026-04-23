<?php
if (!defined('ABSPATH'))
    exit;

class PT_Elementor_Widgets
{

    public function __construct()
    {
        // 1. Hook into Elementor's widget registration
        add_action('elementor/widgets/register', [$this, 'register_pixellers_widgets']);

        // 2. Register your custom category
        add_action('elementor/elements/categories_registered', [$this, 'register_pixellers_category']);
    }

    // Define the custom category for your widgets
    public function register_pixellers_widgets($widgets_manager)
    {
        // 1. Include the Image Widget
        require_once PT_PATH . 'inc/widgets/class-image-widget.php';
        $widgets_manager->register(new \Pixellers\Pixeller_Image_Widget());

        // 2. Include the Button Widget (Add this!)
        require_once PT_PATH . 'inc/widgets/class-button-widget.php';
        $widgets_manager->register(new \Pixellers\Pixeller_Button_Widget());
    }

    // Register all your custom widgets
    public function register_pixellers_widgets($widgets_manager)
    {
        // Include the Image Widget file
        require_once PT_PATH . 'inc/widgets/class-image-widget.php';

        // Register the class
        $widgets_manager->register(new \Pixellers\Pixeller_Image_Widget());
    }
}

// Initialize only if Elementor is loaded to prevent crashes
if (did_action('elementor/loaded')) {
    new PT_Elementor_Widgets();
}
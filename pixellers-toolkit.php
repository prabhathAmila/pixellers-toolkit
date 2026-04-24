<?php
/*
Plugin Name: Pixellers-Toolkit
Description: The professional engine for Pixellers themes.
Version: 1.0.0
Author: Pixellers
*/

if (!defined('ABSPATH'))
    exit;

define('PT_PATH', plugin_dir_path(__FILE__));
define('PT_URL', plugin_dir_url(__FILE__));

class Pixellers_Toolkit
{

    public function __construct()
    {
        // Wait until all plugins are loaded to avoid AJAX crashes
        add_action('plugins_loaded', [$this, 'load_modules']);
    }

    public function load_modules()
    {
        if (!did_action('elementor/loaded'))
            return;

        $modules = glob(PT_PATH . 'inc/*.php');
        if (!empty($modules)) {
            foreach ($modules as $module) {
                require_once $module;
            }
        }
    }
}

new Pixellers_Toolkit();
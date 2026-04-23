<?php
/*
Plugin Name: Pixellers-Toolkit
Description: The professional engine for Pixellers themes.
Version: 1.0.0
Author: Pixellers
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Security: Exit if accessed directly

// Define core constants for path management
define( 'PT_PATH', plugin_dir_path( __FILE__ ) );
define( 'PT_URL', plugin_dir_url( __FILE__ ) );

class Pixellers_Toolkit {

    public function __construct() {
        // Initialize the module loader
        $this->load_modules();
    }

    /**
     * Module Loader:
     * This scans the 'inc' folder and loads every file automatically.
     * This makes your factory infinitely scalable.
     */
    private function load_modules() {
        $modules = glob( PT_PATH . 'inc/*.php' );
        
        if ( ! empty( $modules ) ) {
            foreach ( $modules as $module ) {
                require_once $module;
            }
        }
    }
}

// Start the Engine
new Pixellers_Toolkit();
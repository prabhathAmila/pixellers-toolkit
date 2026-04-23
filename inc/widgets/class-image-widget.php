<?php
namespace Pixellers;
if ( ! defined( 'ABSPATH' ) ) exit;

class Pixeller_Image_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'pixeller_image'; }
    public function get_title() { return 'Pixellers Image Widget'; }
    public function get_icon() { return 'eicon-image'; }
    public function get_categories() { return ['pixellers-widgets']; }

    protected function register_controls() {
        
        // --- CONTENT SECTION ---
        $this->start_controls_section( 'content_section', [ 'label' => 'Image' ] );
        
        $this->add_control( 'image', [
            'label' => 'Choose Image',
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
        ]);

        $this->add_group_control( \Elementor\Group_Control_Image_Size::get_type(), [ 
            'name' => 'thumbnail',
            'default' => 'large' 
        ]);

        $this->end_controls_section();

        // --- STYLE SECTION (Professional Suite) ---
        $this->start_controls_section( 'style_section', [ 
            'label' => 'Style', 
            'tab' => \Elementor\Controls_Manager::TAB_STYLE 
        ]);
        
        $this->add_responsive_control( 'width', [
            'label' => 'Width',
            'type' => \Elementor\Controls_Manager::SLIDER,
            'selectors' => [ '{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}};' ],
        ]);

        $this->add_group_control( \Elementor\Group_Control_Border::get_type(), [ 
            'name' => 'border', 
            'selector' => '{{WRAPPER}} img' 
        ]);

        $this->add_control( 'border_radius', [
            'label' => 'Border Radius',
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'selectors' => [ '{{WRAPPER}} img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);

        $this->add_group_control( \Elementor\Group_Control_Box_Shadow::get_type(), [ 
            'name' => 'box_shadow', 
            'selector' => '{{WRAPPER}} img' 
        ]);

        $this->add_group_control( \Elementor\Group_Control_Css_Filter::get_type(), [ 
            'name' => 'css_filters', 
            'selector' => '{{WRAPPER}} img' 
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $image_html = \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );
        echo '<div class="pt-image-wrapper">' . $image_html . '</div>';
    }
}
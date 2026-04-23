<?php
namespace Pixellers;
if (!defined('ABSPATH'))
    exit;

class Pixeller_Button_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'pixeller_button';
    }
    public function get_title()
    {
        return 'Pixellers Button';
    }
    public function get_icon()
    {
        return 'eicon-button';
    }
    public function get_categories()
    {
        return ['pixellers-widgets'];
    }

    protected function register_controls()
    {
        // 1. CONTENT SECTION
        $this->start_controls_section('content_section', ['label' => 'Button']);
        $this->add_control('text', ['label' => 'Text', 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Book Now']);
        $this->add_control('link', ['label' => 'Link', 'type' => \Elementor\Controls_Manager::URL, 'default' => ['url' => '#']]);
        $this->end_controls_section();

        // 2. STYLE SECTION (Full Suite)
        $this->start_controls_section('style_section', ['label' => 'Style', 'tab' => \Elementor\Controls_Manager::TAB_STYLE]);

        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), ['name' => 'btn_typo', 'selector' => '{{WRAPPER}} .pt-btn']);

        $this->start_tabs('style_tabs');
        // Normal State
        $this->start_tab('normal', ['label' => 'Normal']);
        $this->add_control('bg_color', ['label' => 'Background', 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .pt-btn' => 'background-color: {{VALUE}};']]);
        $this->add_control('text_color', ['label' => 'Text Color', 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .pt-btn' => 'color: {{VALUE}};']]);
        $this->end_tab();

        // Hover State
        $this->start_tab('hover', ['label' => 'Hover']);
        $this->add_control('bg_hover', ['label' => 'Background', 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .pt-btn:hover' => 'background-color: {{VALUE}};']]);
        $this->end_tab();
        $this->end_tabs();

        $this->add_responsive_control('padding', ['label' => 'Padding', 'type' => \Elementor\Controls_Manager::DIMENSIONS, 'selectors' => ['{{WRAPPER}} .pt-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']]);
        $this->add_group_control(\Elementor\Group_Control_Border::get_type(), ['name' => 'border', 'selector' => '{{WRAPPER}} .pt-btn']);
        $this->add_group_control(\Elementor\Group_Control_Box_Shadow::get_type(), ['name' => 'shadow', 'selector' => '{{WRAPPER}} .pt-btn']);
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        echo '<a href="' . esc_url($settings['link']['url']) . '" class="pt-btn">' . esc_html($settings['text']) . '</a>';
    }
}
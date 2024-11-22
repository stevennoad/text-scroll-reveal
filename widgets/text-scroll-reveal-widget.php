<?php

class Text_Scroll_Reveal_Widget extends \Elementor\Widget_Base {

    public function get_script_depends() {
        return [ 'text-scroll-reveal-script' ];
    }

    public function get_name() {
        return 'text_scroll_reveal';
    }

    public function get_title() {
        return __( 'Text Reveal', 'text-scroll-reveal' );
    }

    public function get_icon() {
        return 'eicon-animated-headline';
    }

    public function get_categories() {
        return [ 'basic' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'text-scroll-reveal' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'text_input',
            [
                'label' => __( 'Text', 'text-scroll-reveal' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Enter your text here', 'text-scroll-reveal' ),
                'placeholder' => __( 'Type your text here', 'text-scroll-reveal' ),
            ]
        );

        $this->add_control(
            'html_tag',
            [
                'label' => __( 'HTML Tag', 'text-scroll-reveal' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'p',
                'options' => [
                    'h1' => __( 'H1', 'text-scroll-reveal' ),
                    'h2' => __( 'H2', 'text-scroll-reveal' ),
                    'h3' => __( 'H3', 'text-scroll-reveal' ),
                    'p' => __( 'Paragraph', 'text-scroll-reveal' ),
                    'span' => __( 'Span', 'text-scroll-reveal' ),
                    'div' => __( 'Div', 'text-scroll-reveal' ),
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Text Style', 'text-scroll-reveal' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => __( 'Typography', 'text-scroll-reveal' ),
                'selector' => '{{WRAPPER}} .text-scroll-reveal',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __( 'Text Color', 'text-scroll-reveal' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .text-scroll-reveal' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_align',
            [
                'label' => __( 'Alignment', 'text-scroll-reveal' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'text-scroll-reveal' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'text-scroll-reveal' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'text-scroll-reveal' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __( 'Justify', 'text-scroll-reveal' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .text-scroll-reveal' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        $tag = $settings['html_tag'];
        $text = $settings['text_input'];

        echo "<div class='scroll-reveal'>";
        echo "<{$tag} class='text-scroll-reveal'>" . esc_html( $text ) . "</{$tag}>";
        echo "</div>";
    }


    protected function content_template() {
        ?>
        <#
        var text = settings.text_input;
        var tag = settings.html_tag;
        #>
        <{{ tag }} class="text-scroll-reveal">{{{ text }}}</{{ tag }}>
        <?php
    }
}

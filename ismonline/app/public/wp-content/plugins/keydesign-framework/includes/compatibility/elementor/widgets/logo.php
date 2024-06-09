<?php
namespace KeyDesign\Compatibility\Elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || die();

class KD_Widget_Site_Logo extends Widget_Base {

	public function get_name() {
		return 'kd_site_logo';
	}

	public function get_title() {
		return __( 'Site Logo', 'keydesign-framework' );
	}

	public function get_icon() {
		return 'eicon-image';
	}

	public function get_categories() {
		return array( 'elementskit_headerfooter' );
	}

    public function get_keywords() {
		return [ 'logo', 'image', 'icon' ];
	}

	protected function register_controls() {
        $this->start_controls_section(
			'section_logo',
			[
				'label' => esc_html__( 'Logo', 'keydesign-framework' ),
			]
		);

        $this->add_control(
			'primary_logo_image',
			[
				'label' => esc_html__( 'Primary Image', 'elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'primary_logo_image',
				'default' => 'large',
				'separator' => 'none',
			]
		);

        $this->add_control(
			'secondary_logo_image',
			[
				'label' => esc_html__( 'Secondary Image', 'elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'secondary_logo_image',
				'default' => 'large',
				'separator' => 'none',
			]
		);

        $this->add_control(
			'link_to',
			[
				'label' => esc_html__( 'Link', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'homepage',
				'options' => [
					'homepage' => esc_html__( 'Homepage', 'elementor' ),
					'custom' => esc_html__( 'Custom URL', 'elementor' ),
				],
			]
		);

        $this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'elementor' ),
				'condition' => [
					'link_to' => 'custom',
				],
				'show_label' => false,
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'section_style_logo',
			[
				'label' => esc_html__( 'Logo', 'elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
			'logo_width',
			[
				'label' => esc_html__( 'Width', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'logo_max_width',
			[
				'label' => esc_html__( 'Max Width', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'logo_height',
			[
				'label' => esc_html__( 'Height', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units' => [ 'px', 'vh' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
	}

	protected function render() {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings['primary_logo_image']['url'] ) ) {
			return;
		}

        $image_html = '<span class="primary-logo">';
        $image_html .= \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'primary_logo_image' );
        $image_html .= '</span>';

        if ( ! empty( $settings['secondary_logo_image']['url'] ) ) {
            $image_html .= '<span class="secondary-logo">';
			$image_html .= \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'secondary_logo_image' );
            $image_html .= '</span>';
		}

        $link = $this->get_link_url( $settings );
        if ( $link ) {
			$this->add_link_attributes( 'link', $link );
        }

        $this->add_render_attribute( 'wrapper', 'class', 'site-logo-wrapper' );
        ?>
        <div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
            <a class="site-logo" <?php $this->print_render_attribute_string( 'link' ); ?>>
                <?php echo wp_kses_post( $image_html ); ?>
            </a>
        </div>
        <?php
	}

    protected function get_link_url( $settings ) {

		if ( 'custom' === $settings['link_to'] ) {
			if ( empty( $settings['link']['url'] ) ) {
				return false;
			}

			return $settings['link'];
		}

		return [
			'url' => home_url(),
		];
	}

}
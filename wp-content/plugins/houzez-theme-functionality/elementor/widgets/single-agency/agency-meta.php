<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Houzez_Agency_Meta extends Widget_Base {
	use \HouzezThemeFunctionality\Elementor\Traits\Houzez_Preview_Query;

	public function get_name() {
		return 'houzez-agency-meta';
	}

	public function get_title() {
		return __( 'Agency Meta', 'houzez-theme-functionality' );
	}

	public function get_icon() {
		return 'houzez-element-icon houzez-agency eicon-post-excerpt';
	}

	public function get_categories() {
		if(get_post_type() === 'fts_builder' && htb_get_template_type(get_the_id()) === 'single-agency')  {
            return ['houzez-single-agency-builder']; 
        }

		return [ 'houzez-single-agency' ];
	}

	public function get_keywords() {
		return [ 'houzez', 'agency meta', 'agency' ];
	}

	protected function register_controls() {
		parent::register_controls();

		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Agency Meta', 'houzez-theme-functionality' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
            'agency_custom_field',
            [
                'label' => esc_html__( 'Meta Field', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                	'fave_agency_email' => esc_html__('Email Address', 'houzez-theme-functionality'),
                	'fave_agency_service_area' => esc_html__('Service Areas', 'houzez-theme-functionality'),
                	'fave_agency_specialties' => esc_html__('Specialties', 'houzez-theme-functionality'),
                	'fave_agency_licenses' => esc_html__('License', 'houzez-theme-functionality'),
                	'fave_agency_tax_no' => esc_html__('Tax Number', 'houzez-theme-functionality'),
                	'fave_agency_mobile' => esc_html__('Mobile Number', 'houzez-theme-functionality'),
                	'fave_agency_phone' => esc_html__('Phone Number', 'houzez-theme-functionality'),
                	'fave_agency_fax' => esc_html__('Fax Number', 'houzez-theme-functionality'),
                	'fave_agency_language' => esc_html__('Language', 'houzez-theme-functionality'),
                	'fave_agency_address' => esc_html__('Address', 'houzez-theme-functionality'),
                	'fave_agency_web' => esc_html__('Website', 'houzez-theme-functionality'),
                	'fave_agency_whatsapp' => esc_html__('WhatsApp', 'houzez-theme-functionality'),
                	'fave_agency_line_id' => esc_html__('LINE ID', 'houzez-theme-functionality'),
                	'fave_agency_telegram' => esc_html__('Telegram', 'houzez-theme-functionality'),
                	'fave_agency_skype' => esc_html__('Skype', 'houzez-theme-functionality'),
                	'fave_agency_zillow' => esc_html__('Zillow', 'houzez-theme-functionality'),
                	'fave_agency_realtor_com' => esc_html__('Realtor.com', 'houzez-theme-functionality'),
                	'fave_agency_facebook' => esc_html__('Facebook', 'houzez-theme-functionality'),
                	'fave_agency_twitter' => esc_html__('X', 'houzez-theme-functionality'),
                	'fave_agency_linkedin' => esc_html__('LinkedIn', 'houzez-theme-functionality'),
                	'fave_agency_googleplus' => esc_html__('Google', 'houzez-theme-functionality'),
                	'fave_agency_tiktok' => esc_html__('Tiktok', 'houzez-theme-functionality'),
                	'fave_agency_instagram' => esc_html__('Instagram', 'houzez-theme-functionality'),
                	'fave_agency_pinterest' => esc_html__('Pinterest', 'houzez-theme-functionality'),
                	'fave_agency_youtube' => esc_html__('Youtube', 'houzez-theme-functionality'),
                	'fave_agency_vimeo' => esc_html__('Vimeo', 'houzez-theme-functionality'),
                	//'custom_field' => esc_html__('Custom Field', 'houzez-theme-functionality'),
                ],
				'default' => '',
            ]
        );

        $this->add_control(
			'meta_title',
			[
				'label' => esc_html__( 'Meta Title', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'conditions' => [
                    'terms' => [
                        [
                            'name' => 'agency_custom_field',
                            'operator' => '!in',
                            'value' => [
                                'fave_agency_whatsapp',
                                'fave_agency_line_id',
                                'fave_agency_telegram',
                                'fave_agency_skype',
                                'fave_agency_zillow',
                                'fave_agency_realtor_com',
                                'fave_agency_facebook',
                                'fave_agency_twitter',
                                'fave_agency_linkedin',
                                'fave_agency_googleplus',
                                'fave_agency_tiktok',
                                'fave_agency_instagram',
                                'fave_agency_pinterest',
                                'fave_agency_youtube',
                                'fave_agency_vimeo',
                            ],
                        ],
                    ],
                ],
			]
		);

        $this->add_control(
			'html_tag',
			[
				'label' => esc_html__( 'HTML Tag', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'div',
				'conditions' => [
                    'terms' => [
                        [
                            'name' => 'agency_custom_field',
                            'operator' => '!in',
                            'value' => [
                                'fave_agency_whatsapp',
                                'fave_agency_line_id',
                                'fave_agency_telegram',
                                'fave_agency_skype',
                                'fave_agency_zillow',
                                'fave_agency_realtor_com',
                                'fave_agency_facebook',
                                'fave_agency_twitter',
                                'fave_agency_linkedin',
                                'fave_agency_googleplus',
                                'fave_agency_tiktok',
                                'fave_agency_instagram',
                                'fave_agency_pinterest',
                                'fave_agency_youtube',
                                'fave_agency_vimeo',
                            ],
                        ],
                    ],
                ],
			]
		);

		$this->add_control(
            'custom_icon',
            [
                'label' => esc_html__( 'Custom Icon', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'houzez-theme-functionality' ),
                'label_off' => esc_html__( 'No', 'houzez-theme-functionality' ),
                'return_value' => 'yes',
				'default' => '',
				'conditions' => [
                    'terms' => [
                        [
                            'name' => 'agency_custom_field',
                            'operator' => 'in',
                            'value' => [
                                'fave_agency_whatsapp',
                                'fave_agency_line_id',
                                'fave_agency_telegram',
                                'fave_agency_skype',
                                'fave_agency_zillow',
                                'fave_agency_realtor_com',
                                'fave_agency_facebook',
                                'fave_agency_twitter',
                                'fave_agency_linkedin',
                                'fave_agency_googleplus',
                                'fave_agency_tiktok',
                                'fave_agency_instagram',
                                'fave_agency_pinterest',
                                'fave_agency_youtube',
                                'fave_agency_vimeo',
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
			'meta_icon',
			[
				'label' => esc_html__( 'upload Icon', 'houzez-theme-functionality' ),
				'type' => Controls_Manager::ICONS,
				'condition' => [
                	'custom_icon' => 'yes'
                ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'agency_metasbet_style',
			[
				'label' => esc_html__( 'Content', 'houzez-theme-functionality' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'conditions' => [
                    'terms' => [
                        [
                            'name' => 'agency_custom_field',
                            'operator' => '!in',
                            'value' => [
                                'fave_agent_whatsapp',
                                'fave_agent_line_id',
                                'fave_agent_telegram',
                                'fave_agent_skype',
                                'fave_agent_zillow',
                                'fave_agent_realtor_com',
                                'fave_agent_facebook',
                                'fave_agent_twitter',
                                'fave_agent_linkedin',
                                'fave_agent_googleplus',
                                'fave_agent_tiktok',
                                'fave_agent_instagram',
                                'fave_agent_pinterest',
                                'fave_agent_youtube',
                                'fave_agent_vimeo',
                            ],
                        ],
                    ],
                ],
         
			]
		);

        $this->add_responsive_control(
            'space_between',
            [
                'label' => esc_html__( 'Space Between', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'default' => [
					'unit' => 'px',
					'size' => 10,
				],
                'selectors' => [
                    '{{WRAPPER}} .hzel-meta-field-wrap' => 'column-gap: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_agency_meta_style',
			[
				'label' => esc_html__( 'Meta Title', 'houzez-theme-functionality' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'conditions' => [
                    'terms' => [
                        [
                            'name' => 'agency_custom_field',
                            'operator' => '!in',
                            'value' => [
                                'fave_agency_whatsapp',
                                'fave_agency_line_id',
                                'fave_agency_telegram',
                                'fave_agency_skype',
                                'fave_agency_zillow',
                                'fave_agency_realtor_com',
                                'fave_agency_facebook',
                                'fave_agency_twitter',
                                'fave_agency_linkedin',
                                'fave_agency_googleplus',
                                'fave_agency_tiktok',
                                'fave_agency_instagram',
                                'fave_agency_pinterest',
                                'fave_agency_youtube',
                                'fave_agency_vimeo',
                            ],
                        ],
                    ],
                ],
			]
		);

		$this->add_control(
            'agency_meta_color',
            [
                'label' => esc_html__( 'Color', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::COLOR,
				'selectors' => [
                    '{{WRAPPER}} .hzel-agency-meta-title' => 'color: {{VALUE}};',
                ],
            ]
        );

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'agency_meta_typography',
                'selector' => '{{WRAPPER}} .hzel-agency-meta-title',
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_agency_metav_style',
			[
				'label' => esc_html__( 'Meta Value', 'houzez-theme-functionality' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'conditions' => [
                    'terms' => [
                        [
                            'name' => 'agency_custom_field',
                            'operator' => '!in',
                            'value' => [
                                'fave_agency_whatsapp',
                                'fave_agency_line_id',
                                'fave_agency_telegram',
                                'fave_agency_skype',
                                'fave_agency_zillow',
                                'fave_agency_realtor_com',
                                'fave_agency_facebook',
                                'fave_agency_twitter',
                                'fave_agency_linkedin',
                                'fave_agency_googleplus',
                                'fave_agency_tiktok',
                                'fave_agency_instagram',
                                'fave_agency_pinterest',
                                'fave_agency_youtube',
                                'fave_agency_vimeo',
                            ],
                        ],
                    ],
                ],
			]
		);

		$this->add_control(
            'agency_metav_color',
            [
                'label' => esc_html__( 'Color', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::COLOR,
				'selectors' => [
                    '{{WRAPPER}} .hzel-agency-meta-value' => 'color: {{VALUE}};',
                ],
            ]
        );

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'agency_metav_typography',
                'selector' => '{{WRAPPER}} .hzel-agency-meta-value',
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_agency_meta_icon_style',
			[
				'label' => esc_html__( 'Icon', 'houzez-theme-functionality' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'conditions' => [
                    'terms' => [
                        [
                            'name' => 'agency_custom_field',
                            'operator' => 'in',
                            'value' => [
                                'fave_agency_whatsapp',
                                'fave_agency_line_id',
                                'fave_agency_telegram',
                                'fave_agency_skype',
                                'fave_agency_zillow',
                                'fave_agency_realtor_com',
                                'fave_agency_facebook',
                                'fave_agency_twitter',
                                'fave_agency_linkedin',
                                'fave_agency_googleplus',
                                'fave_agency_tiktok',
                                'fave_agency_instagram',
                                'fave_agency_pinterest',
                                'fave_agency_youtube',
                                'fave_agency_vimeo',
                            ],
                        ],
                    ],
                ],
			]
		);

		$this->add_control(
            'agency_meta_icon_color',
            [
                'label' => esc_html__( 'Color', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::COLOR,
				'selectors' => [
                    '{{WRAPPER}} .hzel-agency-social a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'agency_meta_icon_hover_color',
            [
                'label' => esc_html__( 'Color Hover', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::COLOR,
				'selectors' => [
                    '{{WRAPPER}} .hzel-agency-social a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'agency_meta_icon_size',
            [
                'label' => esc_html__( 'Size', 'houzez-theme-functionality' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'default' => [
					'unit' => 'px',
					'size' => 15,
				],
                'selectors' => [
                    '{{WRAPPER}} .hzel-agency-social a' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .hzel-agency-social a svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();
		
	}

	protected function render() {
		global $settings;
        $this->single_agency_preview_query(); // Only for preview

        $settings = $this->get_settings_for_display();

        $innerHTML = '';
        $this->add_render_attribute( 'agency-meta', 'class', 'hzel-meta-field-wrap' );

        $custom_field = $settings['agency_custom_field'];

        $meta_title = $settings['meta_title'] ?? '';

        if( ! empty($custom_field) ) {
			$field_value = get_post_meta( get_the_ID(), $custom_field, true );

			if( in_array( $custom_field, houzez_realtor_social() ) ) {

				if( $settings['custom_icon'] ) {

					$icon = houzez_render_icon($settings['meta_icon'], [ 'aria-hidden' => 'true' ] );

					$meta_html = '<div class="hzel-agency-social"><a target="_blank" href="'.esc_url( $field_value ).'">
									'.$icon.'
								</a></div>';

				} else {

					$meta_html = '<div class="hzel-agency-social">';
					if( $custom_field == 'fave_agency_facebook' ) {
						$meta_html .= '<a class="btn-facebook" target="_blank" href="'.esc_url( $field_value ).'">
										<i class="houzez-icon icon-social-media-facebook"></i>
									</a>';

					} else if( $custom_field == 'fave_agency_twitter' ) {
						$meta_html .= '<a class="btn-twitter" target="_blank" href="'.esc_url( $field_value ).'">
										<i class="houzez-icon icon-x-logo-twitter-logo-2"></i>
									</a>';
					} else if( $custom_field == 'fave_agency_linkedin' ) {
						$meta_html .= '<a class="btn-linkedin" target="_blank" href="'.esc_url( $field_value ).'">
										<i class="houzez-icon icon-professional-network-linkedin"></i>
									</a>';
					} else if( $custom_field == 'fave_agency_googleplus' ) {
						$meta_html .= '<a class="btn-googleplus" target="_blank" href="'.esc_url( $field_value ).'">
										<i class="houzez-icon icon-social-media-google-plus-1"></i>
									</a>';
					} else if( $custom_field == 'fave_agency_tiktok' ) {
						$meta_html .= '<a class="btn-tiktok" target="_blank" href="'.esc_url( $field_value ).'">
										<i class="houzez-icon icon-tiktok-1-logos-24"></i>
									</a>';
					} else if( $custom_field == 'fave_agency_instagram' ) {
						$meta_html .= '<a class="btn-instagram" target="_blank" href="'.esc_url( $field_value ).'">
										<i class="houzez-icon icon-social-instagram"></i>
									</a>';
					} else if( $custom_field == 'fave_agency_pinterest' ) {
						$meta_html .= '<a class="btn-pinterest" target="_blank" href="'.esc_url( $field_value ).'">
										<i class="houzez-icon icon-social-pinterest"></i>
									</a>';
					} else if( $custom_field == 'fave_agency_youtube' ) {
						$meta_html .= '<a class="btn-youtube" target="_blank" href="'.esc_url( $field_value ).'">
										<i class="houzez-icon icon-social-video-youtube-clip"></i>
									</a>';
					} else if( $custom_field == 'fave_agency_vimeo' ) {
						$meta_html .= '<a class="btn-vimeo" target="_blank" href="'.esc_url( $field_value ).'">
										<i class="houzez-icon icon-social-video-vimeo"></i>
									</a>';
					} else if( $custom_field == 'fave_agency_zillow' ) {
						$meta_html .= '<a class="btn-zillow" target="_blank" href="'.esc_url( $field_value ).'">
										<i class="houzez-icon icon-zillow"></i>
									</a>';
					} else if( $custom_field == 'fave_agency_realtor_com' ) {
						$meta_html .= '<a class="btn-realtor-com" target="_blank" href="'.esc_url( $field_value ).'">
										<i class="houzez-icon icon-realtor-com"></i>
									</a>';
					} else if( $custom_field == 'fave_agency_whatsapp' ) {
						$meta_html .= '<a class="btn-whatsapp" target="_blank" href="https://wa.me/'.esc_attr($field_value).'">
								<i class="houzez-icon icon-messaging-whatsapp"></i>
							</a>';
					} else if( $custom_field == 'fave_agency_line_id' ) {
						$meta_html .= '<a class="btn-lineapp" target="_blank" href="https://line.me/ti/p/~'.esc_attr($field_value).'">
								<i class="houzez-icon icon-lineapp-5"></i>
							</a>';
					} else if( $custom_field == 'fave_agency_skype' ) {
						$meta_html .= '<a class="btn-skype" target="_blank" href="skype:'.esc_attr( $agency_skype ).'?chat">
								<i class="houzez-icon icon-video-meeting-skype"></i>
							</a>';
					} else if( $custom_field == 'fave_agency_telegram' ) {
						$meta_html .= '<a class="btn-telegram" target="_blank" href="'.houzezStandardizeTelegramURL($field_value).'">
								<i class="houzez-icon icon-telegram-logos-24"></i>
							</a>';
					}

					$meta_html .= '</div>';
				}

			} else {

				if( ! empty( $meta_title ) ) {
					$innerHTML .= '<span class="hzel-agency-meta-title">'.$meta_title.'</span>';
				}

				if( ! empty( $field_value ) ) {
					$innerHTML .= '<span class="hzel-agency-meta-value">'.$field_value.'</span>';
				}

				$meta_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', Utils::validate_html_tag( $settings['html_tag'] ), $this->get_render_attribute_string( 'agency-meta' ), $innerHTML );
			}

			if( ! empty( $field_value ) ) {
				echo $meta_html;
			}
		}

		$this->reset_preview_query(); // Only for preview
	}

}
Plugin::instance()->widgets_manager->register( new Houzez_Agency_Meta );
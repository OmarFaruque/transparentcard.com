<?php
/**
 * Sign from throw elementor    
 */


class Elementor_Signup extends \Elementor\Widget_Base {

	public function get_name() {
		return 'hello_world_widget_2';
	}

	public function get_title() {
		return esc_html__( 'Signup Form', 'elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_keywords() {
		return [ 'signup', 'form' ];
	}

	protected function register_controls() {

		// Content Tab Start

		// $this->start_controls_section(
		// 	'section_title',
		// 	[
		// 		'label' => esc_html__( 'Title', 'elementor-addon' ),
		// 		'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
		// 	]
		// );

		// $this->add_control(
		// 	'title',
		// 	[
		// 		'label' => esc_html__( 'Title', 'elementor-addon' ),
		// 		'type' => \Elementor\Controls_Manager::TEXTAREA,
		// 		'default' => esc_html__( 'Hello world', 'elementor-addon' ),
		// 	]
		// );

		// $this->end_controls_section();

		// Content Tab End


		// Style Tab Start

		// $this->start_controls_section(
		// 	'section_title_style',
		// 	[
		// 		'label' => esc_html__( 'Title', 'elementor-addon' ),
		// 		'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		// 	]
		// );

		// $this->add_control(
		// 	'title_color',
		// 	[
		// 		'label' => esc_html__( 'Text Color', 'elementor-addon' ),
		// 		'type' => \Elementor\Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} .hello-world' => 'color: {{VALUE}};',
		// 		],
		// 	]
		// );

		// $this->end_controls_section();

		// Style Tab End

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		?>
		<p class="hello-world">
			<?php
                echo do_shortcode( '[transparent_registration_form]', false );
            ?>
		</p>
		<?php
	}

	protected function content_template() {
		?>
		<!-- <#
		if ( '' === settings.title ) {
			return;
		}
		#> -->
		<p class="hello-world">
        <?php
            echo do_shortcode( '[transparent_registration_form]', false );
        ?>
		</p>
		<?php
	}
}
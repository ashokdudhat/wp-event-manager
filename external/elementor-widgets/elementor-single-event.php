<?php
namespace WPEventManager\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Single Event
 *
 * Elementor widget for single event.
 *
 */
class Elementor_Single_Event extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'single-event';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Single Event', 'wp-event-manager' );
	}
	/**	
	 * Get widget icon.
	 *
	 * Retrieve shortcode widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-menu-toggle';		
	}
	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'single-event', 'code' ];
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'wp-event-manager-categories' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_shortcode',
			[
				'label' => __( 'Single Event', 'wp-event-manager' ),
			]
		);

		$this->add_control(
			'event_id',
			[
				'label'       => __( 'Event Id', 'wp-event-manager' ),
				'type'        => Controls_Manager::NUMBER,
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		if($settings['event_id']>0){
		    $event_id = 'id='.$settings['event_id'];
		    $settings['event_id']='id='.$settings['event_id'];
		}
		else{
		    $event_id = '';
		    $settings['event_id']='';
		}
		echo do_shortcode('[event '.$event_id.' ]');
	}

	/*public function render_plain_content() {
		// In plain mode, render without shortcode
		$settings = $this->get_settings_for_display();

		if($settings['event_id']>0){
			$event_id = 'id='.$settings['event_id'];
			$settings['event_id']='id='.$settings['event_id'];
		}
		else{
			$event_id = '';
			$settings['event_id']='';
		}
		$shortcode = '[event '.$event_id.' ]';
		echo $shortcode;
	}*/

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @access protected
	 */
	protected function _content_template() {

		$shortcode = do_shortcode('[event {{{settings.event_id}}}]');
		?>
		<div class="elementor-shortcode"><?php echo $shortcode; ?></div>
		<?php
	}
}

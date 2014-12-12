<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * WooCommerce Colors Customizer.
 *
 * @package  WC_Colors/Customizer
 * @category Class
 * @author   WooThemes
 */
class WC_Colors_Customizer {

	/**
	 * Section slug.
	 *
	 * @var string
	 */
	public $section_slug = 'woocommerce_colors';

	/**
	 * Initialize the customize actions.
	 */
	public function __construct() {
		add_action( 'customize_register', array( $this, 'register_settings' ) );
		add_action( 'customize_preview_init', array( $this, 'live_preview' ) );
	}

	/**
	 * Register the customizer settings.
	 *
	 * @param \WP_Customize_Manager $wp_customize
	 */
	public function register_settings( $wp_customize ) {

		$wp_customize->add_section( $this->section_slug, array(
			'title'       => __( 'WooCommerce', 'woocommerce-frontend-styles' ),
			'priority'    => 60,
			'description' => __( 'WooCommerce Colors.', 'woocommerce-frontend-styles' )
		) );

		// Primary Color.
		$wp_customize->add_setting( $this->section_slug . '[primary]', array(
			'default'           => '#ad74a2',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'woocommerce_primary', array(
			'label'    => __( 'Primary Color', 'woocommerce-frontend-styles' ),
			'section'  => $this->section_slug,
			'settings' => $this->section_slug . '[primary]',
			'priority' => 1
		) ) );

		// Secondary Color.
		$wp_customize->add_setting( $this->section_slug . '[secondary]', array(
			'default'           => '#f7f6f7',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'woocommerce_secondary', array(
			'label'    => __( 'Secondary Color', 'woocommerce-frontend-styles' ),
			'section'  => $this->section_slug,
			'settings' => $this->section_slug . '[secondary]',
			'priority' => 1
		) ) );

		// Highlight Color.
		$wp_customize->add_setting( $this->section_slug . '[highlight]', array(
			'default'           => '#85ad74',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'woocommerce_highlight', array(
			'label'    => __( 'Highlight Color', 'woocommerce-frontend-styles' ),
			'section'  => $this->section_slug,
			'settings' => $this->section_slug . '[highlight]',
			'priority' => 1
		) ) );

		// Content Background Color.
		$wp_customize->add_setting( $this->section_slug . '[content_bg]', array(
			'default'           => '#ffffff',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'woocommerce_content_bg', array(
			'label'    => __( 'Content Background Color', 'woocommerce-frontend-styles' ),
			'section'  => $this->section_slug,
			'settings' => $this->section_slug . '[content_bg]',
			'priority' => 1
		) ) );

		// Subtext Color.
		$wp_customize->add_setting( $this->section_slug . '[subtext]', array(
			'default'           => '#777777',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'woocommerce_subtext', array(
			'label'    => __( 'Subtext Color', 'woocommerce-frontend-styles' ),
			'section'  => $this->section_slug,
			'settings' => $this->section_slug . '[subtext]',
			'priority' => 1
		) ) );
	}

	/**
	 * Customizer live preview.
	 */
	public function live_preview() {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_enqueue_script( 'woocommerce-frontend-styles-customizer', WC_Colors::get_assets_url() . 'js/customizer' . $suffix . '.js', array( 'jquery', 'customize-preview' ), WC_Colors::VERSION, true );
	}
}

new WC_Colors_Customizer();

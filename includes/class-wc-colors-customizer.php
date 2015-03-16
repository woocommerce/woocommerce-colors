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
		add_action( 'customize_save_after', array( $this, 'save_after' ) );
		add_action( 'wp_head', array( $this, 'header_output' ), 99999 );
	}

	/**
	 * Register the customizer settings.
	 *
	 * @param \WP_Customize_Manager $wp_customize
	 */
	public function register_settings( $wp_customize ) {

		$wp_customize->add_section( $this->section_slug, array(
			'title'       => __( 'WooCommerce', 'woocommerce-colors' ),
			'priority'    => 60,
			'description' => __( 'WooCommerce Colors.', 'woocommerce-colors' )
		) );

		// Primary Color.
		$wp_customize->add_setting( $this->section_slug . '[primary]', array(
			'default'           => '#a46497',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'woocommerce_primary', array(
			'label'    => sprintf( __( 'Primary Color %s', 'woocommerce-colors' ), '<small>(' . __( 'action buttons/price slider/layered nav UI', 'woocommerce-colors' ) . ')</small>' ),
			'section'  => $this->section_slug,
			'settings' => $this->section_slug . '[primary]',
			'priority' => 1
		) ) );

		// Secondary Color.
		$wp_customize->add_setting( $this->section_slug . '[secondary]', array(
			'default'           => '#ebe9eb',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'woocommerce_secondary', array(
			'label'    => sprintf( __( 'Secondary Color %s', 'woocommerce-colors' ), '<small>(' . __( 'buttons and tabs', 'woocommerce-colors' ) . ')</small>' ),
			'section'  => $this->section_slug,
			'settings' => $this->section_slug . '[secondary]',
			'priority' => 1
		) ) );

		// Highlight Color.
		$wp_customize->add_setting( $this->section_slug . '[highlight]', array(
			'default'           => '#77a464',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'woocommerce_highlight', array(
			'label'    => sprintf( __( 'Highlight Color %s', 'woocommerce-colors' ), '<small>(' . __( 'price labels and sale flashes', 'woocommerce-colors' ) . ')</small>' ),
			'section'  => $this->section_slug,
			'settings' => $this->section_slug . '[highlight]',
			'priority' => 1
		) ) );

		// Content Background Color.
		$wp_customize->add_setting( $this->section_slug . '[contentbg]', array(
			'default'           => '#ffffff',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'woocommerce_contentbg', array(
			'label'    => sprintf( __( 'Content Background Color %s', 'woocommerce-colors' ), '<small>(' . __( 'your themes page background - used for tab active states', 'woocommerce-colors' ) . ')</small>' ),
			'section'  => $this->section_slug,
			'settings' => $this->section_slug . '[contentbg]',
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
			'label'    => sprintf( __( 'Subtext Color %s', 'woocommerce-colors' ), '<small>(' . __( 'used for certain text and asides - breadcrumbs, small text etc', 'woocommerce-colors' ) . ')</small>' ),
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

		wp_enqueue_script( 'tinycolor', WC_Colors::get_assets_url() . 'js/tinycolor' . $suffix . '.js', array(), '1.1.1', true );
		wp_enqueue_script( 'woocommerce-colors-customizer', WC_Colors::get_assets_url() . 'js/customizer' . $suffix . '.js', array( 'jquery', 'customize-preview', 'tinycolor' ), WC_Colors::VERSION, true );
	}

	/**
	 * Compile the SCSS.
	 *
	 * @return string
	 */
	protected function compile_scss() {
		if ( ! class_exists( 'scssc' ) && ! class_exists( 'scss_formatter_nested' ) ) {
			include_once 'libs/class-scss.php';
		}

		// Get options
		$colors = WC_Colors::get_options( get_option( 'woocommerce_colors' ) );

		ob_start();
		include 'views/scss.php';
		$scss = ob_get_clean();

		$compiler     = new scssc;
		$compiler->setFormatter( 'scss_formatter_compressed' );
		$compiled_css = $compiler->compile( trim( $scss ) );

		return $compiled_css;
	}

	/**
	 * Save the colors.
	 *
	 * @param WP_Customize_Manager $customize
	 */
	public function save_after( $customize ) {
		if ( ! isset( $_REQUEST['customized'] ) ) {
			return;
		}

		$customized = json_decode( stripslashes( $_REQUEST['customized'] ), true );
		$save       = false;

		foreach ( $customized as $key => $value ) {
			if ( false !== strpos( $key, $this->section_slug ) ) {
				$save = true;
				break;
			}
		}

		if ( $save ) {
			$css = $this->compile_scss();

			update_option( 'woocommerce_colors_css', $css );
		}
	}

	/**
	 * Header output.
	 */
	public function header_output() {
		$css = get_option( 'woocommerce_colors_css' );

		echo "<!-- WooCommerce Colors -->\n";
		echo "<style type=\"text/css\">\n";
		echo $css;
		echo "\n</style>\n";
		echo "<!--/WooCommerce Colors-->\n";
	}
}

new WC_Colors_Customizer();

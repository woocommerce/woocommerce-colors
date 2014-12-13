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
			'label'    => __( 'Primary Color', 'woocommerce-colors' ),
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
			'label'    => __( 'Secondary Color', 'woocommerce-colors' ),
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
			'label'    => __( 'Highlight Color', 'woocommerce-colors' ),
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
			'label'    => __( 'Content Background Color', 'woocommerce-colors' ),
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
			'label'    => __( 'Subtext Color', 'woocommerce-colors' ),
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
	 * Get the plugin options.
	 *
	 * @return array
	 */
	protected function get_options() {
		// Get settings.
		$colors = array_map( 'esc_attr', (array) get_option( 'woocommerce_colors' ) );

		// Defaults.
		if ( empty( $colors['primary'] ) ) {
			$colors['primary'] = '#a46497';
		}
		if ( empty( $colors['secondary'] ) ) {
			$colors['secondary'] = '#ebe9eb';
		}
		if ( empty( $colors['highlight'] ) ) {
			$colors['highlight'] = '#77a464';
		}
		if ( empty( $colors['content_bg'] ) ) {
			$colors['content_bg'] = '#ffffff';
		}
		if ( empty( $colors['subtext'] ) ) {
			$colors['subtext'] = '#777777';
		}

		return $colors;
	}

	/**
	 * Compile the SCSS.
	 *
	 * @return string
	 */
	protected function compile_scss() {
		include_once 'libs/class-scss.php';

		// Get options
		$colors = $this->get_options();

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

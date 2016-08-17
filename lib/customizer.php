<?php

namespace Roots\Sage\Customizer;

use Roots\Sage\Assets;

/**
 * Add postMessage support
 */
function customize_register($wp_customize) {
  $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->add_setting(
		'custom_footer_text',
		[
			'type' => 'theme_mod',
			'default' => 'hello v0.1.0',
			'transport' => 'postMessage' ,
			'sanitize_callback' => 'sanitize_text_field',
		]
	);

	// Add a footer/copyright information section.
	$wp_customize->add_section(
		'custom_footer' ,
		[
			'title' => __( 'Footer', 'hello' ),
			'priority' => 90,// Before Navigation.
		]
	);

	$wp_customize->add_control(
		'custom_footer_text',
		[
			'label' => __( 'Footer text' ),
			'type' => 'textarea',
			'section' => 'custom_footer',
		]
	);
}
add_action('customize_register', __NAMESPACE__ . '\\customize_register');

/**
 * Customizer JS
 */
function customize_preview_js() {
  wp_enqueue_script('hello/customizer', Assets\asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
}
add_action('customize_preview_init', __NAMESPACE__ . '\\customize_preview_js');

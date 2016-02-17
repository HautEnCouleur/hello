<?php
/**
 * Plugins management
 *
 * @package wordpress
 * @subpackage hello
 */

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

function hello_is_plugin_active( $name ){
	switch ($name) {
		case 'composer':
			return is_plugin_active( 'js_composer/js_composer.php' ) ;
		case 'lang':
			return is_plugin_active( 'qtranslate-x/qtranslate.php' ) ;
		default:
			return false ;
	}
}

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/libraries/class-tgm-plugin-activation.php';

/**
 * Register the required plugins for this theme.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function hello_register_js_composer_plugins() {
	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = [[
		'name'          => 'WPBakery Visual Composer', // The plugin name
		'slug'          => 'js_composer', // The plugin slug (typically the folder name)
		'source'            => get_stylesheet_directory() . '/libraries/js_composer.zip', // The plugin source
		'required'          => false, // If false, the plugin is only 'recommended' instead of required
		'version'           => '4.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
		'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		'external_url'      => '', // If set, overrides default API URL and points to an external URL
		'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
	]];

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'hello';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = [
		'domain'        => $theme_text_domain, // Text domain - likely want to be the same as your theme.
		'default_path'      => '', // Default absolute path to pre-packaged plugins
		'parent_slug'   => 'themes.php', // Default parent URL slug
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'menu'          => 'install-required-plugins', // Menu slug
		'has_notices'       => true, // Show admin notices or not
		'is_automatic'      => true, // Automatically activate plugins after installation or not
		'message'       => '', // Message to output right before the plugins table
		'strings'       => [
			'page_title'            => __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'            => __( 'Install Plugins', $theme_text_domain ),
			'installing'            => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'              => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'   => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'    => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'  => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'   => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate'        => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update'      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update'      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link'          => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link'         => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                => __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'          => __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete'              => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'              => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		]
	];
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'hello_register_js_composer_plugins' );


/**
 * breadcrumb shortcode
 */
function hello_breadcrumb_menu( $atts ) {
	if ( has_nav_menu( 'breadcrumb' ) ){
		$locations = get_nav_menu_locations() ;
		$menu_id = wp_get_nav_menu_object( $locations['breadcrumb'] )->term_id ;

		return wp_nav_menu([
			'menu' => $menu_id,
			'echo' => false,
			'menu_class' => 'nav navbar-nav navbar-center',
			'container' => 'nav',
			'container_class' => 'navbar navbar-default navbar-breadcrumb',
			'items_wrap' => '<ul id="%1$s" class="%2$s"><div class="breadcrumb-fix-left"></div><div class="breadcrumb-fix-center"></div><div class="breadcrumb-fix-right"></div>%3$s</ul>',
		]);
	}
}
add_shortcode( 'breadcrumb', 'hello_breadcrumb_menu' );

/**
 * Visual Composer init
 */
function hello_vcSetAsTheme() {
	// Force Visual Composer to initialize as 'built into the theme'.
	// This will hide certain tabs under the Settings->Visual Composer page
	vc_set_as_theme();

	vc_map([
		'name' => __( 'breadcrumb bar', 'hello' ),
		'base' => 'breadcrumb',
		'class' => '',
		'category' => __( 'Theme', 'hello'),
		'show_settings_on_create' => false,
		'params' => []
	]);
}
add_action( 'vc_before_init', 'hello_vcSetAsTheme' );

?>

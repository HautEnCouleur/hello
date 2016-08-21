<?php

  /**
   * For full documentation, please visit: http://docs.reduxframework.com/
   * For a more extensive sample-config file, you may look at:
   * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
   *
  **/

  if ( ! class_exists( 'Redux' ) ) {
      return;
  }

  // This is your option name where all the Redux data is stored.
  $opt_name = 'hello-options';

  function hello_isset($key) {
    global $hello_options ;
    return isset($hello_options[$key]) || array_key_exists($key, $hello_options) ;
  }

  function hello_opt($key) {
    global $hello_options ;
    if ( hello_isset($key) ){
      return $hello_options[$key];
    }
    return '';
  }


  /**
   * ---> SET ARGUMENTS
   * All the possible arguments for Redux.
   * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
   * */

  $theme = wp_get_theme(); // For use with some settings. Not necessary.

  $args = array(
      'dev_mode' => FALSE,
      'forced_dev_mode_off' => TRUE,
      'allow_tracking' => FALSE,
      'templates_path' => get_template_directory() . '/templates/redux',
      'footer_credit' => ' ',
      'opt_name' => 'hello-options',
      'use_cdn' => FALSE,
      'display_name' => 'Hello',
      'display_version' => 'v.3 alpha',
      'page_slug' => 'hello_options',
      'page_title' => 'Hello',
      'admin_bar' => FALSE,
      'menu_type' => 'menu',
      'menu_title' => 'Hello',
      'menu_icon' => get_stylesheet_directory_uri() . '/dist/images/icon-menu.png',
      'footer_credit' => '<a href="'. admin_url('options.php') .'">wp</a> - <a href="'. admin_url('tools.php?page=redux-status') .'">rx</a>',
      'allow_sub_menu' => FALSE,
      'page_priority' => '75',
      'customizer' => TRUE,
      'default_mark' => '',
      'class' => 'hello-options',
      'hints' => array(
          'icon' => 'el el-info-sign',
          'icon_position' => 'right',
          'icon_color' => '#1e73be',
          'icon_size' => 'normal',
          'tip_style' => array(
              'color' => 'light',
              'shadow' => '1',
              'rounded' => '1',
          ),
          'tip_position' => array(
              'my' => 'top left',
              'at' => 'bottom right',
          ),
          'tip_effect' => array(
              'show' => array(
                  'duration' => '500',
                  'event' => 'mouseover',
              ),
              'hide' => array(
                  'duration' => '500',
                  'event' => 'mouseleave unfocus',
              ),
          ),
      ),
      'output' => TRUE,
      'output_tag' => TRUE,
      'settings_api' => TRUE,
      'cdn_check_time' => '1440',
      'compiler' => TRUE,
      'page_permissions' => 'manage_options',
      'save_defaults' => TRUE,
      'show_import_export' => TRUE,
      'database' => 'theme_mods',
      'transient_time' => '3600',
      'hide_reset' => TRUE,
  );

  Redux::setArgs( $opt_name, $args );

  /*
   * ---> END ARGUMENTS
   */

  /*
   *
   * ---> START SECTIONS
   *
  **/
  Redux::setSection( $opt_name, array(
    'title'  => __( 'Branding', 'hello' ),
    'id'     => 'brand',
    'icon'   => 'dashicons dashicons-carrot',
    'fields' => array(
      // array(
      //   'id'       => 'blogname',
      //   'type'     => 'text',
      //   'title'    => __('Site Title'),
      //   'default'  => get_option( 'blogname' ),
      //   'compiler' => true,
      // ),
      // array(
      //   'id'       => 'blogdescription',
      //   'type'     => 'text',
      //   'title'    => __('Tagline'),
      //   'default'  => get_option( 'blogdescription' ),
      //   'compiler' => true,
      // ),
      array(
        'id'       => 'logo',
        'type'     => 'media',
        'url'      => true,
        'title'    => __( 'Logo', 'hello' ),
        'compiler' => 'true',
      ),
      array(
        'id'       => 'logo-mobile',
        'type'     => 'media',
        'url'      => true,
        'title'    => __( 'Logo (mobile version)', 'hello' ),
        'compiler' => 'true',
      ),
    )
  ));

  Redux::setSection( $opt_name, array(
      'title'  => __( 'Contact', 'hello' ),
      'id'     => 'info',
      'icon'   => 'dashicons dashicons-share',
      'fields' => array(
        array(
            'id'       => 'info-email',
            'type'     => 'text',
            'title'    => __( 'Company email', 'hello' ),
            'validate' => 'email',
        ),
        array(
            'id'       => 'info-phone',
            'type'     => 'text',
            'title'    => __( 'Phone number', 'hello' ),
        ),
        array(
            'id'       => 'info-address',
            'type'     => 'textarea',
            'title'    => __( 'Location', 'hello' ),
        ),
        array(
            'id'       => 'info-facebook',
            'type'     => 'text',
            'title'    => __( 'Facebook page', 'hello' ),
            'validate' => 'url',
        ),
        array(
            'id'       => 'info-linkedin',
            'type'     => 'text',
            'title'    => __( 'Linkedin profile link', 'hello' ),
            'validate' => 'url',
            'placeholder' => 'Placeholder Text',
        ),
        array(
            'id'       => 'info-instagram',
            'type'     => 'text',
            'title'    => __( 'Instagram profile link', 'hello' ),
            'validate' => 'url',
        ),
        array(
            'id'       => 'info-twitter',
            'type'     => 'text',
            'title'    => __( 'Twitter profile link', 'hello' ),
            'validate' => 'url',
            'text_hint' => array(
                'title'   => 'Hint Title',
                'content' => 'Hint content about this field!'
            )
        ),
    )
  ) );

  /*
   * <--- END SECTIONS
   */

  /*
   * Remove Demo mode & Dev tweaks
   */

  function hello_redux_init() {
    if ( class_exists('ReduxFrameworkPlugin') ) {
      remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
      remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );

      $GLOBALS['redux_notice_check'] = 0;

    }
  }
  add_action('init', 'hello_redux_init');

  function hello_redux_wp_dashboard_setup() {
    remove_meta_box('redux_dashboard_widget', 'dashboard', 'side');
  }
  add_action('wp_dashboard_setup', 'hello_redux_wp_dashboard_setup', 12);

  function hello_redux_admin_menu() {
      remove_submenu_page('tools.php','redux-about');
  }
  add_action( 'admin_menu', 'hello_redux_admin_menu',12 );


  /*
   * Compiler and Sync code for standard WP Options
   * TODO : manage qTranslate-X fields => this code is erasing the lang markup
   */

  add_filter('redux/options/' . $opt_name . '/compiler', 'hello_redux_sync_options', 10, 3);
  function hello_redux_sync_options( $options, $css, $changed_values ){

    // error_log( var_export($options,true) );
    // error_log( var_export($css,true) );
    // error_log( var_export($changed_values,true) );

    $synced = array('blogdescription', 'blogname');
    foreach($synced as $key){

      if ( isset($changed_values[$key]) || array_key_exists($key, $changed_values) ) {
        if ( get_option($key) != $options[$key] ){
          update_option( $key, $options[$key] );
        }
      }

    }

  }

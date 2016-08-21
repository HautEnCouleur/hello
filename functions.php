<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/class-tgm-plugin-activation.php', // TGM Activation Class
  'lib/setup-plugins.php', // TGM Configuration (plugins dependencies)
  'lib/redux/framework/framework.php', // Redux Framework
  'lib/options.php', // Redux Configuration
  'lib/redux/extensions/extensions-init.php', // Redux extensions
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/admin.php', // Theme Admin functions
  // 'lib/customizer.php', // Legacy theme customizer MOVED TO Redux Framework
  // 'lib/custom-header.php', // Legacy theme Custom Header MOVED TO Redux Framework
  'lib/custom-menu-walker.php' // BS3_Walker_Nav_Menu
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'hello'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

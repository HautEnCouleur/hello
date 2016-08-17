<?php

namespace Roots\Sage\Admin;

use Roots\Sage\Assets;

/**
 * Theme assets
 */
function admin_assets() {
  wp_enqueue_style('hello/admin/css', Assets\asset_path('styles/admin.css'), false, null);

  wp_enqueue_script('hello/admin/js', Assets\asset_path('scripts/admin.js'), ['jquery'], null, true);
}
add_action('admin_enqueue_scripts', __NAMESPACE__ . '\\admin_assets', 100);

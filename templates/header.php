<header class="banner" role="banner">
  <nav class="navbar navbar-inverse navbar-static-top nav-primary">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-toggle.collapsed" href="#" data-toggle="offcanvas" data-target=".offcanvas-sidebar">
          <i class="fa fa-lg fa-bars"></i>
        </a>
        <?php if ( get_header_image() ) : ?>
          <a class="brand navbar-logo" href="<?= esc_url(home_url('/')); ?>">
            <img src="<?= header_image(); ?>"/>
          </a>
        <?php elseif ( display_header_text() ) : ?>
          <a class="brand navbar-brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
        <?php endif; ?>
      </div>
      <div id="header-menu" class="offcanvas-xs">
        <!-- <ul class="nav navbar-nav"> -->
          <?php
          if (has_nav_menu('primary_navigation')) :
            wp_nav_menu(array( 'container_class' => 'menu-header', 'theme_location' => 'primary_navigation', 'items_wrap' => '<ul id="%1$s" class="%2$s nav navbar-nav">%3$s</ul>', 'walker' => new BS3_Walker_Nav_Menu));
          endif;
          ?>
        <!-- </ul> -->
      </div>
    </div>
  </nav>
</header>

<header class="banner" role="banner">
  <nav class="navbar navbar-inverse navbar-static-top nav-primary">
    <div class="container">

      <div class="logo">
        <?php if ( hello_isset('logo') ) : ?>
          <a class="brand navbar-logo hidden-xs" href="<?= esc_url(home_url('/')); ?>">
            <img src="<?= hello_opt('logo')['url'] ?>"/>
          </a>
          <a class="brand navbar-logo mobile visible-xs-inline hidden-sm" href="<?= esc_url(home_url('/')); ?>">
            <?php if ( hello_isset('logo-mobile') ) : ?>
              <img src="<?= hello_opt('logo-mobile')['url'] ?>"/>
            <?php elseif ( display_header_text() ) : ?>
              <img src="<?= hello_opt('logo')['url'] ?>"/>
            <?php endif; ?>
          </a>
        <?php elseif ( display_header_text() ) : ?>
          <a class="brand navbar-brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
        <?php endif; ?>
      </div>


      <div class="nav-helper pull-right">
        <?php
          if (has_nav_menu('helper_navigation')) :
            wp_nav_menu(array(
              'container' => '',
              'theme_location' => 'helper_navigation',
              'items_wrap' => '<ul id="%1$s" class="%2$s nav navbar-nav">%3$s</ul>',
              'walker' => new BS3_Walker_Nav_Menu
            ));
          endif;
        ?>
        <button role="button" class="btn btn-link navbar-btn"><i class="fa fa-search"></i></button>
      </div>
      
      <div class="hidden-xs">

        <div class="slogan">
          <span><?php bloginfo( 'description' ); ?></span>
        </div>

        <?php
          if (has_nav_menu('primary_navigation')) :
            wp_nav_menu(array(
              'container_class' => 'navbar-primary',
              'theme_location' => 'primary_navigation',
              'items_wrap' => '<ul id="%1$s" class="%2$s nav navbar-nav">%3$s</ul>',
              'walker' => new BS3_Walker_Nav_Menu
            ));
          endif;
        ?>
      </div>

      <!--
      <a class="navbar-toggle.collapsed" href="#" data-toggle="offcanvas" data-target=".offcanvas-sidebar">
        <i class="fa fa-lg fa-bars"></i>
      </a>
       -->
    </div><!-- end container -->
  </nav><!-- end navbar -->
</header>

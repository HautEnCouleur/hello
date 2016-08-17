<footer class="content-info">
  <div class="container">
    <div class"row">
      <div class="col-xs-12 col-md-4">

        <?php // Contact card config
          $contact = array(
            array(
              'slug' => 'info-email',
              'icon' => 'fa fa-envelope',
            ),
            array(
              'slug' => 'info-phone',
              'icon' => 'fa fa-phone',
            ),
            array(
              'slug' => 'info-address',
              'icon' => 'fa fa-map-marker',
            ),
          );
        ?>

        <?php foreach ($contact as $o) : ?>
          <?php if ( hello_isset($o['slug']) ) : ?>
            <div class="media">
              <div class="media-left media-middle">
                <i class="<?= $o['icon'] ?> fa-fw fa-2x"></i>
              </div>
              <div class="media-body">
                <p><?= hello_opt($o['slug']) ?></p>
              </div>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>

        <hr/>


        <?php // Contact card config
          $social = array(
            array(
              'slug' => 'info-facebook',
              'icon' => 'fa fa-facebook',
              'icon-type' => 'stacked',
            ),
            array(
              'slug' => 'info-linkedin',
              'icon' => 'fa fa-linkedin',
              'icon-type' => 'stacked',
            ),
            array(
              'slug' => 'info-instagram',
              'icon' => 'fa fa-instagram',
              'icon-type' => 'normal',
            ),
            array(
              'slug' => 'info-twitter',
              'icon' => 'fa fa-twitter',
              'icon-type' => 'stacked',
            ),
          );
        ?>

        <?php foreach ($social as $o) : ?>
          <?php if ( hello_isset($o['slug']) ) : ?>
            <a class="btn btn-link btn" href="<?= hello_opt($o['slug']) ?>">
              <?php if ( $o['icon-type'] === 'stacked' ) : ?>
                <span class="fa-stack fa-lg">
                  <i class="fa fa-square-o fa-stack-2x"></i>
                  <i class="<?= $o['icon'] ?> fa-stack-1x"></i>
                </span>
              <?php else : ?>
                <span class="fa-stack fa-lg">
                  <i class="<?= $o['icon'] ?> fa-stack-2x"></i>
                </span>
              <?php endif; ?>
            </a>
          <?php endif; ?>
        <?php endforeach; ?>

      </div>
      <div class="col-xs-12 col-md-8">
        <div class"row">
          <div class="col-xs-12 col-sm-6 col-md-4">
            <?php dynamic_sidebar('sidebar-footer-1'); ?>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4">
            <?php dynamic_sidebar('sidebar-footer-2'); ?>
          </div>
          <div class="col-xs-12 col-sm-6 col-sm-3 col-md-4">
            <?php dynamic_sidebar('sidebar-footer-3'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

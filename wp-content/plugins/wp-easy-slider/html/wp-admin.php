<?php
/*
Plugin Name: WP-Easy Slider
Author: Jordi Salord Font <jordi@graficlab.com>
License: GPL version v2.0

Admin HTML structure based on administrator page of WP-AutoSocial plugin by @paucapo http://capo.cat/wp-autosocial/
*/
if (!constant('WES_URL'))
      die("You can't access this file directly");

if (!current_user_can('manage_options')) {
      wp_die(__('You do not have sufficient permissions to access this page.'));
}
?>
<div class="wrap">
      <div id="icon-options-general" class="icon32"><br /></div>
      <h2>WP Easy Slider</h2>
      <div class="metabox-holder has-right-sidebar">
            <div class="inner-sidebar">
                  <?php
                  require 'wp-admin-sidebar.php';
                  ?>
            </div>
            <div class="has-sidebar sm-padded">
                  <div id="post-body-content" class="has-sidebar-content">
                        <div class="meta-box-sortabless">
                              <div class="postbox">
                                    <h3 class="hndle"><?php _e('Instructions', 'wp-easy-slider'); ?></h3>
                                    <div class="inside">
                                          <?php echo '<p>' . __('Just add a built-in WordPress image gallery on any post or page, and then WP Easy Slider will make it bit awesome :).') . '</p>'; ?>
                                    </div>
                              </div>
                              <?php
                              require 'wp-admin-form.php';
                              ?>
                        </div>
                  </div>
            </div>
            <br style="clear:both" />
      </div>
</div>
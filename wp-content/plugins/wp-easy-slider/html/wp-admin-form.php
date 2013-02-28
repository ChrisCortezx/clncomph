<?php
/*
Plugin Name: WP-Easy Slider
Author: Jordi Salord Font <jordi@graficlab.com>
License: GPL version v2.0
*/
if (!constant('WES_URL'))
      die("You can't access this file directly");

if (isset($_GET['reset'])) {
      //EasySlider::uninstall();
      echo '<div class="updated settings-error"><p><strong>' . __('Settings have been reset.', 'wp-easy-slider') . '</strong></p></div>';
}
?>
<form action="<?php echo WES_ADMIN_URL; ?>" method="post">
      <div class="postbox">
            <h3 class="hndle"><?php _e('Future settings', 'wp-easy-slider'); ?></h3>
            <div class="inside">

                  <table class="form-table" style="clear:none">
                        
                        <tr valign="top">
                              <th scope="row"><label for="wes_showloading"><?php _e('Show loading spin', 'wp-easy-slider'); ?></label></th>
                              <td>
                                    <input disabled name="wes_showloading" type="checkbox" id="wes_showloading" />
                                    <em><?php _e('It will show a loading spin before showing images', 'wp-easy-slider'); ?></em>
                              </td>
                        </tr>
                        
                        <tr valign="top">
                              <th scope="row"><label for="wes_loadingstyle"><?php _e('Loading style', 'wp-easy-slider'); ?></label></th>
                              <td>
                                    <select disabled name="wes_loadingstyle" id="wes_loadingstyle">
                                          <option value="default">Default</option>
                                          <option value="fadein">Fade in</option>
                                    </select>
                              </td>
                        </tr>

                        <tr valign="top">
                              <th scope="row"><label for="wes_replacegallery"><?php _e('Replace image gallery', 'wp-easy-slider'); ?></label></th>
                              <td>
                                    <input disabled name="wes_replacegallery" type="checkbox" id="wes_replacegallery" />
                                    <em><?php _e('It will put an inline slider', 'wp-easy-slider'); ?></em>
                              </td>
                        </tr>
                        
                        <tr><td><hr /></td></tr>
                        
                        <tr valign="top">
                              <td colspan="2">
                                    <strong><?php _e("When replacing gallery", 'wp-easy-slider'); ?></strong>
                              </td>
                        </tr>
                        
                        <tr valign="top">
                              <th scope="row"><label for="wes_gallerystyle"><?php _e('Slider style', 'wp-easy-slider'); ?></label></th>
                              <td>
                                    <select disabled name="wes_gallerystyle" id="wes_gallerystyle">
                                          <option value="default">Default</option>
                                          <option value="fadein">Fade in</option>
                                    </select>
                              </td>
                        </tr>
                        
                        <tr><td><hr /></td></tr>
                        
                        <tr valign="top">
                              <td colspan="2">
                                    <strong><?php _e("When not replacing gallery", 'wp-easy-slider'); ?></strong>
                              </td>
                        </tr>
                        
                        <tr valign="top">
                              <th scope="row"><label for="wes_style"><?php _e('Slider style', 'wp-easy-slider'); ?></label></th>
                              <td>
                                    <select disabled name="wes_style" id="wes_style">
                                          <option value="default">Default</option>
                                          <option value="fadein">Fade in</option>
                                    </select>
                              </td>
                        </tr>
                        
                        <tr valign="top">
                              <th scope="row"><label for="wes_shadowcolor"><?php _e('Shadow color', 'wp-easy-slider'); ?></label></th>
                              <td>
                                    <input disabled name="wes_shadowcolor" type="text" id="wes_shadowcolor" />
                              </td>
                        </tr>
                        
                        <tr valign="top">
                              <th scope="row"><label for="wes_shadowopacity"><?php _e('Shadow opacity', 'wp-easy-slider'); ?></label></th>
                              <td>
                                    <input disabled name="wes_shadowopacity" type="text" id="wes_shadowopacity" />
                              </td>
                        </tr>

                  </table>
            </div>
      </div>

      <p class="submit">
            <input disabled type="submit" name="submit" value="<?php _e('Save Changes', 'wp-easy-slider'); ?>" class="button-primary" />
            <a href="<?php echo WES_ADMIN_URL; ?>&reset" class="button-secondary" style="display:none;"><?php _e('Reset', 'wp-easy-slider'); ?></a>
      </p>
</form>
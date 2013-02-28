<?php
/*
  Plugin Name: WP-Easy Slider
  Plugin URI: http://www.jordisalord.com/wp-easy-slider/
  Description: An easy slider for WordPress built-in image galleries
  Version: 0.2.2
  Author: Jordi Salord Font <jordi@graficlab.com>
  Author URI: http://www.jordisalord.com
  Text Domain: wp-easy-slider
  License: GPL version v2.0 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
define('WES_NAME', 'wp-easy-slider');
define('WES_URL', WP_PLUGIN_URL . '/'.WES_NAME.'/');
define('WES_PATH', dirname(__FILE__));
define('WES_ADMIN_URL', get_admin_url() . 'options-general.php?page=' . basename(__FILE__));

class EasySlider {

      function EasySlider() {
            if (is_admin()) {
                  //register_activation_hook(__FILE__, array(&$this, 'activate'));
                  //register_deactivation_hook(__FILE__, array(&$this, 'deactivate'));
                  //register_uninstall_hook(__FILE__, array(&$this, 'uninstall'));
                  add_action('plugin_action_links', array(&$this, 'pluginActionLinks'), 10, 4);

                  add_action('init', array(&$this, 'adminInit'));
                  add_action('admin_menu', array(&$this, 'adminMenu'));
            } else {
                  add_action('init', array(&$this, 'init'));
                  add_action('wp_footer', array(&$this, 'wpFooter'));
            }
            load_plugin_textdomain(WES_NAME, false, WES_PATH . '/lang');
      }

      /* back end */

      function adminInit() {
            if (isset($_POST['action']) && isset($_POST['wes-form'])) {
                  
            }
      }

      function activate() {
            
      }

      function deactivate() {
            
      }

      public static function uninstall() {
            
      }

      function adminMenu() { //sidebar settings menu
            add_options_page('WP Easy Slider', 'WP Easy Slider', 'manage_options', basename(__FILE__), array(&$this, 'options'));
      }

      function options() { //easy slider administration page
            require 'html/wp-admin.php';
      }

      function pluginActionLinks($links, $file) { //plugins list settings link
            if ($file == 'wp-easy-slider/' . basename(__FILE__)) {
                  $settings_link = '<a href="options-general.php?page=' . basename(__FILE__) . '" title="' . __('Settings') . '">' . __('Settings') . '</a>';
                  array_unshift($links, $settings_link);
            }
            return $links;
      }

      function getChangelog($n = 1) {
            $data = file_get_contents(WES_PATH . '/readme.txt');

            $str = '== Changelog ==';
            $start = strpos($data, $str);

            $tail = substr($data, $start + strlen($str));
            unset($data);

            $end = strpos($tail, '==');

            $out = substr($tail, 0, $end);
            unset($tail);
            $lines = explode("\n", $out);
            unset($out);

            echo '<div class="postbox">';
            $c = 0;
            foreach ($lines as $k => $v) {
                  if ($v) {
                        if ($v[0] == '=') {
                              if ($c < $n) {
                                    echo '<h3 class="hndle">Changelog ' . trim(str_replace('=', '', $v)) . '</h3><div class="inside"><ol>';
                                    $c++;
                              }
                              else
                                    break;
                        } elseif ($v[0] == '*') {
                              echo '<li>' . trim(substr($v, 1)) . '</li>';
                        }
                  }
            }
            unset($lines);
            echo '</ol></div></div>';
      }

      /* front end */

      function init() {
            if (!isset($_SESSION)) {
                  @session_cache_limiter('private, must-revalidate');
                  @session_start();
            }
            wp_enqueue_script('jquery');
            wp_enqueue_script('jqueryeasyslider', WP_PLUGIN_URL . '/wp-easy-slider/jquery.easy-slider.js', array('jquery'));
      }

      function wpFooter() {
            global $wp_query, $wpdb, $post;
            $content = '';
            require 'html/wp-footer.php';
            return $content;
      }

}

new EasySlider;
?>
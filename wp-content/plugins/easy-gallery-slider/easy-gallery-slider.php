<?php
/**
 * 
 * Plugin Name: Easy Gallery Slider
 * Description: Responsive slider uses the images attached to a post or page. Simple to customize and configure.
 * Author: Daniel Berkman
 * Version: 0.6.5
 */

/** This line prevents accessing the file directly. **/
defined('ABSPATH') or die("Cannot access pages directly.");

/** Constants **/
define('EGSLIDER_VER', '0.6.5');
define('EGSLIDER_PATH', plugin_dir_path(__FILE__));
define('EGSLIDER_URL', plugins_url('',__FILE__).'/');

add_action( 'wp_head', 'easygalleryslider_mainquerytest', 0 );
function easygalleryslider_mainquerytest() {
	global $egs_mqt, $post;
	$egs_mqt = array(null,0);
	$egs = get_option('easygalleryslider');
	switch($egs[auto_insert]) {
		case "1": $egs[auto_insert] = false; break;
		case "2": $egs[auto_insert] = is_single(); break;
		case "3": $egs[auto_insert] = is_page(); break;
		case "4": $egs[auto_insert] = is_singular(); break;
	}
	if($egs[auto_insert] && !is_home()) { 
			$egs_mqt[0] = $post->ID;
			add_filter('the_content','easygalleryslider_insert_hook');
			add_action('wp_enqueue_scripts', 'easygalleryslider_enqueue');
			if ($egs[shortcode] == true) add_shortcode( 'egslider', 'egs_shortcode' );
	}
	elseif ($egs[shortcode] == true && !is_home()) {
		$egs_mqt[0] = $post->ID;
		add_action('wp_enqueue_scripts', 'easygalleryslider_enqueue');
		add_shortcode( 'egslider', 'egs_shortcode' );
	}
}

function easygalleryslider_insert_hook($content) {
	global $egs_mqt;
	if ($egs_mqt[0] == get_the_id()) {
		$content = easygalleryslider_insert().$content;
		//$egs_mqt[0] = null;
	}
	return $content;
}

function easygalleryslider_insert() {
	global $egs_mqt;
	$egs_mqt[1]++;
	$egs = get_option('easygalleryslider');
	$egs[num_slides] = $egs[num_slides] > 0? (int)$egs[num_slides] : -1;
	$order = $egs[order] == 3 ? 'DESC' : 'ASC';
	$egs[order] = $egs[order] == 1 ? 'menu_order' : 'date';
	$args = array(	'post_parent' => get_the_id(),
					'post_type' => 'attachment',
					'order'=> $order,
					'orderby'=> $egs[order],
					'numberposts' => $egs[num_slides],
					'post_mime_type' => 'image' );
	if ($egs[exclude] == true) { 
		add_filter( 'posts_where', 'easygalleryslider_where_filter', 10);
		$args[suppress_filters] = FALSE;
	}
	$images = get_children($args);
	if(count($images) > 0) {
		$egs_class = ($egs[spinner]? ' egs-loading' : '');
		if (is_array($egs[css])) {
			foreach ($egs[css] as $css => $val) {
				if ($val) $egs_class .= ' '.$css;
			}
		}
		$imgerr = $egs[debug][imgerr] == 'off'? '' : ' onerror="egs_imgerr(this);"';
		$content = '';
		$content = '<div class="easygalleryslider'.$egs_class.'" id="egs-'.$egs_mqt[1].'"><ul class="slides" style="margin:0;">';
		foreach ($images as $image) {
			$tt_opts = '&a='.$egs[crop];
			if($img = wp_get_attachment_image_src($image->ID,'full')) {
				$width = $egs[width];
				$height = $egs[height];
				if ($egs[enlarge] <> 1) {
					switch($egs[enlarge_xy]) {
						case "1" : $enlarge_xy = $img[1]<$egs[width] || $img[2]<$egs[height]; break;
						case "2" : $enlarge_xy = $img[1]<$egs[width] && $img[2]<$egs[height]; break;
						case "3" : $enlarge_xy = $img[1]<$egs[width]; break;
						case "4" : $enlarge_xy = $img[2]<$egs[height]; break;
					}
					if ($enlarge_xy) {
						if ($egs[enlarge] == 2) { 
							if(empty($egs[matte])) $tt_opts .= '&zc=3';
							else { $egs[matte] = str_replace('#','',$egs[matte]); $tt_opts .= '&zc=2&cc='.$egs[matte]; }
						}
						elseif ($egs[enlarge] == 3) $tt_opts .= '&zc=0';
						elseif ($egs[enlarge] == 4) {
							$width = $img[1] < $egs[width]? $img[1] : $egs[width];
							$height = $img[2] < $egs[height]? $img[2] : $egs[height];
						}
					}
				}
				$img_link = '';
				if ($egs[img_link] == 2 && preg_match("/<!--+([^-]+)--+>/i",$image->post_content,$url) > 0) {
					$img_link = egs_url_valid($url[1]);
					if (!empty($img_link)) $img_link = '<a href="'.$img_link.'" class="'.str_replace('*',$egs_mqt[1],$egs[img_link_class]).'" rel="'.str_replace('*',$egs_mqt[1],$egs[img_link_class]).'">';
					else $img_link = '';
				}
				elseif ($egs[img_link] == 1) $img_link = '<a href="'.$img[0].'" target="_blank" class="'.str_replace('*',$egs_mqt[1],$egs[img_link_class]).'">';
				$zoom = '';
				if ($egs[img_link_zoom]) {
					$zoom = '<a href="'.$img[0].'" target="_blank" class="'.str_replace('*',$egs_mqt[1],$egs[img_link_zoom_class]).' egs-zoom" rel="'.str_replace('*',$egs_mqt[1],$egs[img_link_zoom_class]).'">Enlarge</a>';
				}
				if ($egs[debug][tt] == 'off') $content .= '<li>'.$img_link.'<img src="'.$img[0].'"'.$imgerr.' />';
				else $content .= '<li>'.$img_link.'<img src="'.EGSLIDER_URL.'timthumb.php?src='.urlencode($img[0]).'&w='.$width.'&h='.$height.$tt_opts.'"'.$imgerr.' />';
				if(($egs[title]||$egs[description])== true) { 
					if ($egs[title] && !empty($image->post_title)) {
						$content .= '<p class="flex-caption"><span class="egs-title">'.$image->post_title.'</span>';
						if($egs[description] && !empty($image->post_content)) $content .= '<br />'.$image->post_content;
						$content .= '</p>';
					}
					elseif ($egs[description] && !empty($image->post_content)) 
						$content .= '<p class="flex-caption">'.$image->post_content.'</p>';
				}
				$content .= ((!empty($img_link))? '</a>' : '').$zoom.'</li>';
			}
		}
		$content .= '</ul></div>
					<script type="text/javascript" charset="utf-8">
					'.(($egs_mqt[1] == 1)? 'function egs_imgerr(img) { jQuery(img).closest("li").replaceWith("<!--image not found-->"); }' : '').'
  					jQuery(window).load(function() {jQuery("#egs-'.$egs_mqt[1].'").flexslider({';
		$fsoptions = $egs[fs];
		foreach($fsoptions as $key => $value) {
			if ($value === true) $value = "true";
			elseif ($value === false) $value = "false";
			elseif (is_numeric($value)) $value = (int) $value;
			else $value = "'$value'";
			$content .= "\n".$key.": ".$value.",";
		}
		if ($egs[spinner]) $content .= "\nstart: function(slider) {slider.removeClass('egs-loading');}";
			$content.= '});}); </script>';
	}
	else $content = '<!--Easy Gallery Slider found no images-->';
	return $content;
}

function easygalleryslider_where_filter($where) {
	remove_filter( 'posts_where', 'easygalleryslider_where_filter', 10);
	$where .= " AND menu_order < 999";
	return $where;
}

function egs_url_valid($url) {
	//preg_match("/<!--+([^-]+)--+>/i",$url,$url);
	$link = null;
		preg_match("/^(?:(?:https?|ftp):\/\/)[a-z0-9][-a-z0-9]*\.[a-z0-9][-a-z0-9]*\/?[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]$/i", $url, $link); 
	if (!$link)
		preg_match("/^\/[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]$/i", $url, $link);
	if (empty($link)) $link = null;
	else $link = $link[0];
	return $link;
}

// PHP function
function egs_display(){
	echo easygalleryslider_insert();
}

// [egslider] shortcode
function egs_shortcode( $atts=null ){
	$content = '';
	global $egs_mqt;
	if ($egs_mqt[0] == get_the_id()) {
		$content = easygalleryslider_insert();
	}
	return $content;
}

// Enqueue CSS and scripts
function easygalleryslider_enqueue() {
	if (!is_admin()) {
		$isStyleUrl = EGSLIDER_URL.'flexslider.css';
		$isStyleFile = EGSLIDER_PATH . 'flexslider.css';
		if ( file_exists($isStyleFile) ) {
			wp_register_style('flexslider-Style', $isStyleUrl);
			wp_enqueue_style( 'flexslider-Style');
		}
		$isStyleUrl = EGSLIDER_URL.'easygalleryslider.css';
		$isStyleFile = EGSLIDER_PATH . 'easygalleryslider.css';
		if ( file_exists($isStyleFile) ) {	
			wp_register_style('easygalleryslider', $isStyleUrl);
			wp_enqueue_style( 'easygalleryslider');
		}
	wp_enqueue_script('flexslider', EGSLIDER_URL .'jquery.flexslider-min.js', array('jquery'));
	}
}

/************************
       Admin side
*************************/

add_action('admin_init', 'easygalleryslider_update');

include 'admin-page/admin-page.php';

//Plugin page action link
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'easygalleryslider_action_links' );
function easygalleryslider_action_links($links) {
	$settings_link = '<a href="options-general.php?page=easygalleryslider">' . __( 'Settings' ) . '</a>';

	array_unshift( $links, $settings_link );

	return $links;	
}

//Plugin Activation and Updating
function easygalleryslider_activator() {
	global $wpdb;
	if (function_exists('is_multisite') && is_multisite()) {
		// check if it is a network activation - if so, run the activation function for each blog id
		if (isset($_GET['networkwide']) && ($_GET['networkwide'] == 1)) {
	                $old_blog = $wpdb->blogid;
			// Get all blog ids
			$blogids = $wpdb->get_col($wpdb->prepare("SELECT blog_id FROM $wpdb->blogs"));
			foreach ($blogids as $blog_id) {
				switch_to_blog($blog_id);
				easygalleryslider_activate();
			}
			switch_to_blog($old_blog);
			return;
		}	
	}
	easygalleryslider_activate();
}
function easygalleryslider_update() {
	$opt = get_option('easygalleryslider');
	if(empty($opt[ver]) || $opt[ver] <> EGSLIDER_VER) {
		$opt = easygalleryslider_defaults($opt);

		// upgrade to 0.6.4 best fit for changed option
		if ($opt[enlarge] === true) $opt[enlarge] = 1;
		elseif ($opt[enlarge] === false) { $opt[enlarge] = 2; $opt[enlarge_xy] = 3; }
		
		$opt[ver] = EGSLIDER_VER;
		update_option('easygalleryslider',$opt);
		add_action('admin_notices', 'easygalleryslider_adnotice');
		if (is_dir(EGSLIDER_PATH.'/cache')) {
			$perm = substr(sprintf('%o', fileperms(EGSLIDER_PATH.'cache')), -4);
			if ($perm <> '0775' && $perm <> '0777')
				chmod(EGSLIDER_PATH.'/cache', 0775);
		}
		else { mkdir(EGSLIDER_PATH.'/cache',0775); chmod(EGSLIDER_PATH.'/cache', 0775); }
		$perm = substr(sprintf('%o', fileperms(EGSLIDER_PATH.'timthumb.php')), -4);
		if ($perm <> '0755' && $perm <> '0775')
			chmod(EGSLIDER_PATH.'timthumb.php',0755);
	}
}

function easygalleryslider_adnotice() { echo '<div class="updated"><p>Easy Gallery Slider was updated and permissions reset. Check your <a href="options-general.php?page=easygalleryslider">settings</a> and test your sliders!</p></div>'; }

function easygalleryslider_defaults($opt=null) {
	$egs = array();
	$egs[ver] = isset($opt[ver])? $opt[ver] : '';
	$egs[fs][animation] = isset($opt[fs][animation])? $opt[fs][animation] : 'fade';
	$egs[fs][slideDirection] = isset($opt[fs][slideDirection])? $opt[fs][slideDirection] : 'horizontal';
	$egs[fs][slideshow] = isset($opt[fs][slideshow])? $opt[fs][slideshow] : true;
	$egs[fs][slideshowSpeed] = isset($opt[fs][slideshowSpeed])? $opt[fs][slideshowSpeed] : 5000;
	$egs[fs][animationDuration] = isset($opt[fs][animationDuration])? $opt[fs][animationDuration] : 600;
	$egs[fs][directionNav] = isset($opt[fs][directionNav])? $opt[fs][directionNav] : false;
	$egs[fs][controlNav] = isset($opt[fs][controlNav])? $opt[fs][controlNav] : true;
	$egs[fs][keyboardNav] = isset($opt[fs][keyboardNav])? $opt[fs][keyboardNav] : false;
	$egs[fs][mousewheel] = isset($opt[fs][mousewheel])? $opt[fs][mousewheel] : false;
	$egs[fs][pausePlay] = isset($opt[fs][pausePlay])? $opt[fs][pausePlay] : false;
	$egs[fs][randomize] = isset($opt[fs][randomize])? $opt[fs][randomize] : false;
	$egs[fs][animationLoop] = isset($opt[fs][animationLoop])? $opt[fs][animationLoop] : true;
	$egs[fs][pauseOnAction] = isset($opt[fs][pauseOnAction])? $opt[fs][pauseOnAction] : false;
	$egs[fs][pauseOnHover] = isset($opt[fs][pauseOnHover])? $opt[fs][pauseOnHover] : false;
	$egs[width] = isset($opt[width])? $opt[width] : 1000;
	$egs[height] = isset($opt[height])? $opt[height] : 300;
	$egs[enlarge] = isset($opt[enlarge])? $opt[enlarge] : 1;
	$egs[enlarge_xy] = isset($opt[enlarge_xy])? $opt[enlarge_xy] : 1;
	$egs[matte] = isset($opt[matte])? $opt[matte] : '';
	$egs[auto_insert] = isset($opt[auto_insert])? $opt[auto_insert] : 1;
	$egs[title] = isset($opt[title])? $opt[title] : false;
	$egs[description] = isset($opt[description])? $opt[description] : false;
	$egs[img_link] = isset($opt[img_link])? $opt[img_link] : false;
	$egs[img_link_class] = isset($opt[img_link_class])? $opt[img_link_class] : '';
	$egs[img_link_zoom] = isset($opt[img_link_zoom])? $opt[img_link_zoom] : false;
	$egs[img_link_zoom_class] = isset($opt[img_link_zoom_class])? $opt[img_link_zoom_class] : '';
	$egs[spinner] = isset($opt[spinner])? $opt[spinner] : false;
	$egs[shortcode] = isset($opt[shortcode])? $opt[shortcode] : false;
	$egs[exclude] = isset($opt[exclude])? $opt[exclude] : false;
	$egs[num_slides] = isset($opt[num_slides])? $opt[num_slides] : 0;
	$egs[order] = isset($opt[order])? $opt[order] : 1;
	$egs[crop] =  isset($opt[crop])? $opt[crop] : 'c';
	$egs[css][br] = isset($opt[css][br])? $opt[css][br] : true;
	return $egs;
}
function easygalleryslider_activate() {
	$opt = get_option('easygalleryslider');
	$egs = easygalleryslider_defaults($opt);
	update_option('easygalleryslider',$egs);
}
register_activation_hook( __FILE__, 'easygalleryslider_activator' );

?>

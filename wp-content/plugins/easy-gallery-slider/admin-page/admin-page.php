<?php
/** This line prevents accessing the file directly. **/
defined('ABSPATH') or die("Cannot access pages directly.");

// Admin Options Page

add_action('admin_init', 'easygalleryslider_admin_init');
function easygalleryslider_admin_init(){
	add_settings_section('easygalleryslider_options', 'Plugin Settings', 'easygalleryslider_section_text', 'easygalleryslider');
	add_settings_field('auto_insert', 'Automatically insert above', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_options', array('field' => 'auto_insert', 'label_for' => 'easygalleryslider[auto_insert]'));
	add_settings_field('shortcode', 'Enable shortcode/PHP function', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_options', array('field' => 'shortcode', 'label_for' => 'easygalleryslider[shortcode]'));

	add_settings_section('easygalleryslider_appearance_options', 'Default Animation and Structure', 'easygalleryslider_section_text', 'easygalleryslider');
	add_settings_field('width', 'Max Width', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_appearance_options', array('field' => 'width', 'label_for' => 'easygalleryslider[width]'));
	add_settings_field('height', 'Max Height', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_appearance_options', array('field' => 'height', 'label_for' => 'easygalleryslider[height]'));
	add_settings_field('num_slides', 'Number of slides', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_appearance_options', array('field' => 'num_slides', 'label_for' => 'easygalleryslider[num_slides]'));
	add_settings_field('fs_slideshow', 'Automatically Slide', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_appearance_options', array('field' => 'fs_slideshow', 'label_for' => 'easygalleryslider[fs_slideshow]'));
	add_settings_field('fs_speed', 'Slideshow Speed', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_appearance_options', array('field' => 'fs_speed', 'label_for' => 'easygalleryslider[fs_speed]'));
	add_settings_field('fs_duration', 'Animation Duration', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_appearance_options', array('field' => 'fs_duration', 'label_for' => 'easygalleryslider[fs_duration]'));
	add_settings_field('fs_animation', 'Animation Style', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_appearance_options', array('field' => 'fs_animation', 'label_for' => 'easygalleryslider[fs_animation]'));
	add_settings_field('fs_slide_direction', 'Slide Direction', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_appearance_options', array('field' => 'fs_slide_direction', 'label_for' => 'easygalleryslider[fs_slide_direction]'));
	add_settings_field('spinner', 'Show loading spinner', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_appearance_options', array('field' => 'spinner', 'label_for' => 'easygalleryslider[spinner]'));
	add_settings_field('fs_random', 'Randomize slides', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_appearance_options', array('field' => 'fs_random', 'label_for' => 'easygalleryslider[fs_random]'));
	add_settings_field('order', 'Order slides by', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_appearance_options', array('field' => 'order', 'label_for' => 'easygalleryslider[order]'));
	add_settings_field('exclude', 'Exclude images with menu order higher than 999', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_appearance_options', array('field' => 'exclude', 'label_for' => 'easygalleryslider[exclude]'));

	add_settings_section('easygalleryslider_style_options', 'Default Appearance', 'easygalleryslider_section_text', 'easygalleryslider');
	add_settings_field('title', 'Show titles', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_style_options', array('field' => 'title', 'label_for' => 'easygalleryslider[title]'));
	add_settings_field('description', 'Show description', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_style_options', array('field' => 'description', 'label_for' => 'easygalleryslider[description]'));
	add_settings_field('crop', 'Crop position', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_style_options', array('field' => 'crop', 'label_for' => 'easygalleryslider[crop]'));
	add_settings_field('enlarge', 'Small images', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_style_options', array('field' => 'enlarge', 'label_for' => 'easygalleryslider[enlarge]'));
	add_settings_field('enlarge_xy', 'Small images determined by', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_style_options', array('field' => 'enlarge_xy', 'label_for' => 'easygalleryslider[enlarge_xy]'));
	add_settings_field('matte', 'Small images background color', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_style_options', array('field' => 'matte', 'label_for' => 'easygalleryslider[matte]'));
	add_settings_field('css_br', 'Rounded Corners', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_style_options', array('field' => 'css_br', 'label_for' => 'easygalleryslider[css_br]'));
	
	add_settings_section('easygalleryslider_navigation_options', 'Default Navigation and Interaction', 'easygalleryslider_section_text', 'easygalleryslider');
	add_settings_field('fs_loop', 'Loop animation', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_navigation_options', array('field' => 'fs_loop', 'label_for' => 'easygalleryslider[fs_loop]'));
	add_settings_field('fs_actionpause', 'Pause when buttons clicked', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_navigation_options', array('field' => 'fs_actionpause', 'label_for' => 'easygalleryslider[fs_actionpause]'));
	add_settings_field('fs_hover', 'Pause slideshow when hovering', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_navigation_options', array('field' => 'fs_hover', 'label_for' => 'easygalleryslider[fs_hover]'));
	add_settings_field('fs_directionnav', 'Show prev/next buttons', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_navigation_options', array('field' => 'fs_directionnav', 'label_for' => 'easygalleryslider[fs_directionnav]'));
	add_settings_field('fs_controlnav', 'Show navigation "dots"', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_navigation_options', array('field' => 'fs_controlnav', 'label_for' => 'easygalleryslider[fs_controlnav]'));
	add_settings_field('fs_pause', 'Show pause/play button', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_navigation_options', array('field' => 'fs_pause', 'label_for' => 'easygalleryslider[fs_pause]'));
	add_settings_field('fs_keynav', 'Keyboard navigation', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_navigation_options', array('field' => 'fs_keynav', 'label_for' => 'easygalleryslider[fs_keynav]'));
	add_settings_field('fs_mousewheel', 'Mouse scroll wheel navigation', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_navigation_options', array('field' => 'fs_mousewheel', 'label_for' => 'easygalleryslider[fs_mousewheel]'));
	add_settings_field('img_link', 'Link slides to', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_navigation_options', array('field' => 'img_link', 'label_for' => 'easygalleryslider[img_link]'));
	add_settings_field('img_link_class', 'Link slides "class" and "rel"', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_navigation_options', array('field' => 'img_link_class', 'label_for' => 'easygalleryslider[img_link_class]'));
	add_settings_field('img_link_zoom', 'Zoom button', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_navigation_options', array('field' => 'img_link_zoom', 'label_for' => 'easygalleryslider[img_link_zoom]'));
	add_settings_field('img_link_zoom_class', 'Zoom button "class and "rel"', 'easygalleryslider_field_text', 'easygalleryslider', 'easygalleryslider_navigation_options', array('field' => 'img_link_zoom_class', 'label_for' => 'easygalleryslider[img_link_zoom_class]'));

	register_setting( 'easygalleryslider_options', 'easygalleryslider', 'easygalleryslider_options_validate' );
}

function easygalleryslider_section_text() { echo ''; }

function easygalleryslider_field_text($args) {
	$egsoptions = get_option('easygalleryslider');
	switch($args['field']) {
		case "fs_animation":
			echo '<select id="'.$args['label_for'].'" name="easygalleryslider[fs][animation]"><option value="fade"'.(($egsoptions[fs][animation]=='fade')?' selected="selected"':"").'>fade</option><option value="slide"'.(($egsoptions[fs][animation]=='slide')?' selected="selected"':"").'>slide</option></select>'; break;
		case "fs_slide_direction":
			echo '<select id="'.$args['label_for'].'" name="easygalleryslider[fs][slideDirection]"><option value="horizontal"'.(($egsoptions[fs][slideDirection]=='horizontal')?' selected="selected"':"").'>horizontal</option><option value="vertical"'.(($egsoptions[fs][slideDirection]=='vertical')?' selected="selected"':"").'>vertical</option></select><div class="egs-opinfo">for "slide" animation style</div>'; break;
		case "fs_slideshow":
			echo '<input type="checkbox" id="'.$args['label_for'].'" name="easygalleryslider[fs][slideshow]" value="true"'.(($egsoptions[fs][slideshow]==true)?' checked="checked"':"").' />'; break;
		case "fs_speed":
			echo '<input type="text" id="'.$args['label_for'].'" name="easygalleryslider[fs][slideshowSpeed]" size="3" value="'.$egsoptions[fs][slideshowSpeed].'" /> ms'; break;
		case "fs_duration":
			echo '<input type="text" id="'.$args['label_for'].'" name="easygalleryslider[fs][animationDuration]" size="3" value="'.$egsoptions[fs][animationDuration].'" /> ms'; break;
		case "fs_directionnav":
			echo '<input type="checkbox" id="'.$args['label_for'].'" name="easygalleryslider[fs][directionNav]" value="true"'.(($egsoptions[fs][directionNav]==true)?' checked="checked"':"").' />'; break;
		case "fs_controlnav":
			echo '<input type="checkbox" id="'.$args['label_for'].'" name="easygalleryslider[fs][controlNav]" value="true"'.(($egsoptions[fs][controlNav]==true)?' checked="checked"':"").' />'; break;
		case "fs_keynav":
			echo '<input type="checkbox" id="'.$args['label_for'].'" name="easygalleryslider[fs][keyboardNav]" value="true"'.(($egsoptions[fs][keyboardNav]==true)?' checked="checked"':"").' />'; break;
		case "fs_mousewheel":
			echo '<input type="checkbox" id="'.$args['label_for'].'" name="easygalleryslider[fs][mousewheel]" value="true"'.(($egsoptions[fs][mousewheel]==true)?' checked="checked"':"").' />'; break;
		case "fs_pause":
			echo '<input type="checkbox" id="'.$args['label_for'].'" name="easygalleryslider[fs][pausePlay]" value="true"'.(($egsoptions[fs][pausePlay]==true)?' checked="checked"':"").' />'; break;
		case "fs_random":
			echo '<input type="checkbox" id="'.$args['label_for'].'" name="easygalleryslider[fs][randomize]" value="true"'.(($egsoptions[fs][randomize]==true)?' checked="checked"':"").' />'; break;
		case "fs_loop":
			echo '<input type="checkbox" id="'.$args['label_for'].'" name="easygalleryslider[fs][animationLoop]" value="true"'.(($egsoptions[fs][animationLoop]==true)?' checked="checked"':"").' /><div class="egs-opinfo">This applies to automatic sliding and manual. If manual, clicking next on the last slide will bring you to the first.'; break;
		case "fs_actionpause":
			echo '<input type="checkbox" id="'.$args['label_for'].'" name="easygalleryslider[fs][pauseOnAction]" value="true"'.(($egsoptions[fs][pauseOnAction]==true)?' checked="checked"':"").' />'; break;
		case "fs_hover":
			echo '<input type="checkbox" id="'.$args['label_for'].'" name="easygalleryslider[fs][pauseOnHover]" value="true"'.(($egsoptions[fs][pauseOnHover]==true)?' checked="checked"':"").' />'; break;
		case "width":
			echo '<input type="text" id="'.$args['label_for'].'" name="easygalleryslider[width]" size="3" value="'.$egsoptions[width].'" /> px<div class="egs-opinfo">This is the maximum width the slider will expand to if the page and any container it may be in allows.</div>'; break;
		case "height":
			echo '<input type="text" id="'.$args['label_for'].'" name="easygalleryslider[height]" size="3" value="'.$egsoptions[height].'" /> px<div class="egs-opinfo">This is the maximum height the slider will expand to if the page and any container it may be in allows.</div>'; break;
		case "enlarge":
			echo '<select id="'.$args['label_for'].'" name="easygalleryslider[enlarge]"><option value="1"'.(($egsoptions[enlarge]===1)?' selected="selected"':"").'>enlarge to fill</option><option value="2"'.(($egsoptions[enlarge]===2)?' selected="selected"':"").'>enlarge to fit</option><option value="3"'.(($egsoptions[enlarge]===3)?' selected="selected"':"").'>stretch to fill</option><option value="4"'.(($egsoptions[enlarge]===4)?' selected="selected"':"").'>don\'t enlarge</option></select><div class="egs-opinfo"><u>enlarge to fit</u>: The slider may shrink. Use a background color to avoid this.<br /><u>don\'t enlarge</u>: The slider may shrink.<br /><em>The max dimensions are used to determine small images.</em></div>'; break;
		case "enlarge_xy":
			echo '<select id="'.$args['label_for'].'" name="easygalleryslider[enlarge_xy]"><option value="1"'.(($egsoptions[enlarge_xy]===1)?' selected="selected"':"").'>either</option><option value="2"'.(($egsoptions[enlarge_xy]===2)?' selected="selected"':"").'>both</option><option value="3"'.(($egsoptions[enlarge_xy]===3)?' selected="selected"':"").'>width</option><option value="4"'.(($egsoptions[enlarge_xy]===4)?' selected="selected"':"").'>height</option></select><div class="egs-opinfo"><em>If option selected here is smaller than max dimensions (defined above), the image is considered small.</em></div>'; break;
		case "matte":
			echo '<input type="text" id="'.$args['label_for'].'" name="easygalleryslider[matte]" size="5" value="'.$egsoptions[matte].'" /><div id="farb-colorpick" style="display:none;"></div><div class="egs-opinfo">HTML color. Using this makes small images appear on a background of the max height & length (specified above) and maintains the dimensions of the slider. Currently only available for "enlarge to fit".<br /><strong>Leave blank for no background.</strong></div>'; break;
		case "auto_insert":
			echo '<select id="'.$args['label_for'].'" name="easygalleryslider[auto_insert]"><option value="1"'.(($egsoptions[auto_insert]===1)?' selected="selected"':"").'>none</option><option value="2"'.(($egsoptions[auto_insert]===2)?' selected="selected"':"").'>posts</option><option value="3"'.(($egsoptions[auto_insert]===3)?' selected="selected"':"").'>pages</option><option value="4"'.(($egsoptions[auto_insert]===4)?' selected="selected"':"").'>pages & post</option></select>'; break;
		case "title":
			echo '<input type="checkbox" id="'.$args['label_for'].'" name="easygalleryslider[title]" value="true"'.(($egsoptions[title]==true)?' checked="checked"':"").' /><div class="egs-opinfo">The title is set per image on the Gallery tab of the Add Media box</div>'; break;
		case "description":
			echo '<input type="checkbox" id="'.$args['label_for'].'" name="easygalleryslider[description]" value="true"'.(($egsoptions[description]==true)?' checked="checked"':"").' /><div class="egs-opinfo">The description is set per image on the Gallery tab of the Add Media box</div>'; break;
		case "shortcode":
			echo '<input type="checkbox" id="'.$args['label_for'].'" name="easygalleryslider[shortcode]" value="true"'.(($egsoptions[shortcode]==true)?' checked="checked"':"").' /><br /><div class="egs-opinfo">Scripts will load on every page.</div>'; break;
		case "exclude":
			echo '<input type="checkbox" id="'.$args['label_for'].'" name="easygalleryslider[exclude]" value="true"'.(($egsoptions[exclude]==true)?' checked="checked"':"").' /><div class="egs-opinfo">The menu order field is on the Gallery attachment tab of the individual posts.</div>'; break;
		case "num_slides":
			echo '<input type="text" id="'.$args['label_for'].'" name="easygalleryslider[num_slides]" size="3" value="'.$egsoptions[num_slides].'" /><br /><div class="egs-opinfo">Blank or 0 for unlimited.</div>'; break;
		case "order":
			echo '<select id="'.$args['label_for'].'" name="easygalleryslider[order]"><option value="1"'.(($egsoptions[order]===1)?' selected="selected"':"").'>menu order</option><option value="2"'.(($egsoptions[order]===2)?' selected="selected"':"").'>date (ascending)</option><option value="3"'.(($egsoptions[order]===3)?' selected="selected"':"").'>date (descending)</option></select>'; break;
		case "crop":
			echo '<select id="'.$args['label_for'].'" name="easygalleryslider[crop]"><option value="c"'.(($egsoptions[crop]=='c')?' selected="selected"':"").'>center</option><option value="l"'.(($egsoptions[crop]=='l')?' selected="selected"':"").'>left</option><option value="r"'.(($egsoptions[crop]=='r')?' selected="selected"':"").'>right</option><option value="t"'.(($egsoptions[crop]=='t')?' selected="selected"':"").'>top</option><option value="tr"'.(($egsoptions[crop]=='tr')?' selected="selected"':"").'>top right</option><option value="tl"'.(($egsoptions[crop]=='tl')?' selected="selected"':"").'>top left</option><option value="b"'.(($egsoptions[crop]=='b')?' selected="selected"':"").'>bottom</option><option value="br"'.(($egsoptions[crop]=='br')?' selected="selected"':"").'>bottom right</option><option value="bl"'.(($egsoptions[crop]=='bl')?' selected="selected"':"").'>bottom left</option></select><div class="egs-opinfo">The default (and most common) is "center"</div>'; break;
		case "spinner":
			echo '<input type="checkbox" id="'.$args['label_for'].'" name="easygalleryslider[spinner]" value="true"'.(($egsoptions[spinner]==true)?' checked="checked"':"").' /><div class="egs-opinfo">The height of the spinner is 100px and the slider is 150px.</div>'; break;
		case "css_br":
			echo '<input type="checkbox" id="'.$args['label_for'].'" name="easygalleryslider[css][br]" value="true"'.(($egsoptions[css][br]==true)?' checked="checked"':"").' /><div class="egs-opinfo">Top left and right rounded corners for entire slider.</div>'; break;
		case "img_link":
			echo '<select id="'.$args['label_for'].'" name="easygalleryslider[img_link]"><option value="3"'.(($egsoptions[img_link]==false)?' selected="selected"':"").'>none</option><option value="1"'.(($egsoptions[img_link]===1)?' selected="selected"':"").'>self</option><option value="2"'.(($egsoptions[img_link]===2)?' selected="selected"':"").'>custom links</option></select><div class="egs-opinfo"><p><strong>Link to self:</strong> The entire image is linked to the original image file. Can be used with popups like "lightboxes".</p><p><strong>Custom Links:</strong> If a link is found in the description, that entire image will become a link. The link <strong>must</strong> be enclosed in an HTML comment:<span style="display:block;text-align:center;font-weight:600;font-family:monospace;">&#60;!--http://www.abc.com--></span><em>Relative links are allowed.</em></p></div>'; break;
		case "img_link_class":
			echo '<input type="text" id="'.$args['label_for'].'" name="easygalleryslider[img_link_class]" size="7" value="'.$egsoptions[img_link_class].'" /><br /><div class="egs-opinfo">This class will be added to the slide link (as "class" and "rel" attributes). Mostly used for Lightbox plugins. <p>Use an asterisk* and it will be replaced with the slider ID. (like "lightbox[*]")</p></div>'; break;
		case "img_link_zoom":
			echo '<input type="checkbox" id="'.$args['label_for'].'" name="easygalleryslider[img_link_zoom]" value="true"'.(($egsoptions[img_link_zoom]==true)?' checked="checked"':"").' /><div class="egs-opinfo">Display a button linked to the original image file. Mostly used with Lightbox plugins.</div>'; break;
		case "img_link_zoom_class":
			echo '<input type="text" id="'.$args['label_for'].'" name="easygalleryslider[img_link_zoom_class]" size="7" value="'.$egsoptions[img_link_zoom_class].'" /><br /><div class="egs-opinfo">This class will be added to the zoom button (as "class" and "rel" attributes). Used for Lightbox plugins. <p>Use an asterisk* and it will be replaced with the slider ID. (like "lightbox[*]")</p></div>'; break;
			
	}
}

function easygalleryslider_options_validate($input) {
	$egs = get_option('easygalleryslider');
	if (!empty($input[debug])) {
		if ($input[debug][reset] == 'yes') {
			$output = easygalleryslider_defaults();
			return $output;
		}
		$output = $egs;
		$debug = array();
		$debug[imgerr] = ($input[debug][imgerr] == 'off')? 'off' : null;
		$debug[tt] = ($input[debug][tt] == 'off')? 'off' : null;
		if (!array_filter($debug)) unset($output[debug]);
		else $output[debug] = $debug;
		return $output;
	}
	$output[ver] = isset($egs[ver])? $egs[ver] : '';
	$output[fs][animation] = $input[fs][animation]==('fade'||'slide')? $input[fs][animation] : $egs[fs][animation];
	$output[fs][slideDirection] = $input[fs][slideDirection]==('horizontal'||'vertical')? $input[fs][slideDirection] : $egs[fs][slideDirection];
	$output[fs][slideshow] = $input[fs][slideshow]=='true'? true : false;
	$output[fs][slideshowSpeed] = is_numeric($input[fs][slideshowSpeed])? (int)$input[fs][slideshowSpeed] : $egs[fs][slideshowSpeed];
	$output[fs][animationDuration] = is_numeric($input[fs][animationDuration])? (int)$input[fs][animationDuration] : $egs[fs][animationDuration];
	$output[fs][directionNav] = $input[fs][directionNav]=='true'? true : false;
	$output[fs][controlNav] = $input[fs][controlNav]=='true'? true : false;
	$output[fs][keyboardNav] = $input[fs][keyboardNav]=='true'? true : false;
	$output[fs][mousewheel] = $input[fs][mousewheel]=='true'? true : false;
	$output[fs][pausePlay] = $input[fs][pausePlay]=='true'? true : false;
	$output[fs][randomize] = $input[fs][randomize]=='true'? true : false;
	$output[fs][animationLoop] = $input[fs][animationLoop]=='true'? true : false;
	$output[fs][pauseOnAction] = $input[fs][pauseOnAction]=='true'? true : false;
	$output[fs][pauseOnHover] = $input[fs][pauseOnHover]=='true'? true : false;
	$output[width] = is_numeric($input[width])? (int)$input[width] : $egs[width];
	$output[height] = is_numeric($input[height])? (int)$input[height] : $egs[height];
	$output[enlarge] = $input[enlarge]==(1||2||3||4)? (int)$input[enlarge] : $egs[enlarge];
	$output[enlarge_xy] = $input[enlarge_xy]==(1||2||3||4)? (int)$input[enlarge_xy] : $egs[enlarge_xy];
	$output[matte] = ((preg_match('/^#[a-f0-9]+$/i', $input[matte])&&strlen($input[matte])==7||strlen($input[matte])==4)||$input[matte]=='')? $input[matte] : $egs[matte];
	$output[auto_insert] = $input[auto_insert]==(1||2||3||4)? (int)$input[auto_insert] : $egs[auto_insert];
	$output[spinner] = $input[spinner]=='true'? true : false;
	$output[title] = $input[title]=='true'? true : false;
	$output[description] = $input[description]=='true'? true : false;
	$output[shortcode] = $input[shortcode]=='true'? true : false;
	$output[exclude] = $input[exclude]=='true'? true : false;
	if ($input[num_slides] == ('0'||'')) $output[num_slides] = 0;
	else $output[num_slides] = is_numeric($input[num_slides])? (int)$input[num_slides] : $egs[num_slides];
	$output[order] = $input[order]==(1||2||3)? (int)$input[order] : $egs[order];
	$output[crop] = $input[crop]==('c'||'l'||'r'||'t'||'tl'||'tr'||'b'||'bl'||'br')? $input[crop] : $egs[crop];
	$output[css][br] = $input[css][br]=='true'? true : false;
	$output[img_link] = $input[img_link]==(1||2)? (int)$input[img_link] : false;
	$output[img_link_class] = strip_tags($input[img_link_class]);
	$output[img_link_zoom] = $input[img_link_zoom]=='true'? true : false;
	$output[img_link_zoom_class] = strip_tags($input[img_link_zoom_class]);
	return $output;
}

add_action('admin_menu', 'easygalleryslider_admin_add_page');
function easygalleryslider_admin_add_page() {
	add_options_page('Easy Gallery Slider', 'Easy Gallery Slider', 'manage_options', 'easygalleryslider', 'easygalleryslider_options_page');
}

add_action('admin_print_scripts-settings_page_easygalleryslider', 'easygalleryslider_admin_enqueue');
function easygalleryslider_admin_enqueue() {
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_style('egs-admin-style',plugins_url('style.css', __FILE__));
	wp_enqueue_style( 'farbtastic' );
	wp_enqueue_script( 'farbtastic' );
}

function easygalleryslider_options_page() {
	$egsoptions = get_option('easygalleryslider');
	include('admin-screen.php');
}
?>

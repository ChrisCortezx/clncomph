<?php
/** This line prevents accessing the file directly. **/
defined('ABSPATH') or die("Cannot access pages directly.");
?>

<script type="text/javascript">jQuery(document).ready(function(){
		jQuery( "#egs-tabs" ).tabs({
			selected: -1,
			collapsible: true,
			fx: { height: 'toggle', opacity: 'toggle' }
		});
		jQuery('#egs-settings h3').click(function() {
			jQuery(this).next().toggle();
			return false;
		});
		jQuery('#egs-settings h3').not(':eq(0)').next().hide();
		jQuery('#easygalleryslider\\[fs_animation\\]').change(function() { egs_field_hs(this,'#easygalleryslider\\[fs_slide_direction\\]','slide'); }).trigger('change');
		jQuery('#easygalleryslider\\[img_link\\]').change(function() { egs_field_hs(this,'#easygalleryslider\\[img_link_class\\]',-3); }).trigger('change');
		jQuery('#easygalleryslider\\[img_link_zoom\\]').change(function() { egs_field_hs(this,'#easygalleryslider\\[img_link_zoom_class\\]','true'); }).trigger('change');
		jQuery('#easygalleryslider\\[enlarge\\]').change(function() {egs_field_hs(this,'#easygalleryslider\\[matte\\]',2);egs_field_hs(this,'#easygalleryslider\\[enlarge_xy\\]',-1);}).trigger('change');
		jQuery('#farb-colorpick').farbtastic('#easygalleryslider\\[matte\\]');
		jQuery("#easygalleryslider\\[matte\\]").click(function(){if(jQuery(this).val() == ""){jQuery(this).val('#ffffff');} 	jQuery('#farb-colorpick').fadeIn();});
		jQuery("#easygalleryslider\\[matte\\]").blur(function(){jQuery('#farb-colorpick').fadeOut();});
	});
	function egs_field_hs(sub,tar,cond) {
		var subval = jQuery(sub).children('option:selected').val();
		if (!subval || subval==null) { subval = jQuery(sub).prop("checked"); cond = Boolean(cond); }
		if (subval == parseFloat(subval)) {
			if ((cond < 0 && subval != -cond) || (subval == cond && cond > 0)) { jQuery(tar).parent('td').parent('tr').show(); }
			else { jQuery(tar).parent('td').parent('tr').hide(); } }
		else { 	if ( subval == cond) jQuery(tar).parent('td').parent('tr').show();
				else jQuery(tar).parent('td').parent('tr').hide(); }
	}
</script>
<div>
<h2>Easy Gallery Slider<?php if(isset($egsoptions[debug])) echo ' <span style="font-size:10px;color:red;">Help > Advanced Options are active</span>' ?></h2>
<div id="egs-tabs">
<ul id="egs-tab-top"><li><a href="#egs-help"><img src="<?php echo EGSLIDER_URL; ?>admin-page/helpbk.png" border=0 />Documentation</a></li><li<?php if(isset($egsoptions[debug])) echo ' class="debug"'; ?>><a href="#egs-contact"><img src="<?php echo EGSLIDER_URL; ?>admin-page/caution.png" border=0 /> Help</a></li><li><a href="#egs-donate"><img src="<?php echo EGSLIDER_URL; ?>admin-page/thumbup.png" border=0 /> Donate</a></li></ul><div style="clear:both;"></div>
<div id="egs-help" class="egs-tabs">
	<p class="egs-heading">Selecting images</p>
	<div class="egs-body">When displayed on a singular page (a post or page) by default the images attached to that post or page are used. If there are attached images you'd like to be excluded, set the menu order to 999 and check the "Exclude images" option below.<p class="egs-sub">Directions on attaching images can be found <a href="http://codex.wordpress.org/Inserting_Images_into_Posts_and_Pages" target="_blank">here</a> (only steps 1-3 are necessary.)</p></div>
	<p class="egs-heading">Displaying the slider</p>
	<div class="egs-body"><p>You can display the slider in three ways.</p>
	<span class="egs-inhead">Automatically</span><div>The slider will be inserted between the title and content of every post, page or both.<p class="egs-sub">Set the "Automatically insert above" option below.</p></div>
	<p style="clear:both;height:5px;"></p>
	<span class="egs-inhead">Shortcode</span><div>Use the shortcode <b>[egslider]</b>
	<p class="egs-sub">Be sure to check "Enable shortcode/PHP function" below.</p></div>
	<p style="clear:both;height:5px;"></p>
	<span class="egs-inhead">PHP Function</span> <div>Insert the following code in a template file: <?php highlight_string("<?php egs_display(); ?>"); ?><br/>
	<p class="egs-sub">Be sure to check "Enable shortcode/PHP function" below.</p></div>
	</div>
	<p class="egs-heading">Theming the slider</p>
	<div class="egs-body"><p>Currently the only methods available to theme the slider are direct edits and CSS additions. Regarding buttons, the plugin directory contains a folder called "theme" and you can replace the images there with your own. Make backups because direct edits and changes to the "theme" folder will be overwritten when updating this plugin.</p>
	<p>More theme options are planned for future releases, like the "Rounded Corners" option under "Default Appearance" below.</p>
	</div>
</div>
<div id="egs-contact" class="egs-tabs">
<div>
Have you encountered a problem you can't solve? Find a bug? Have a request for a new feature?
<p class="egs-heading">Visit the website below and contact the author</p>
<p class="egs-heading"><a href="http://inexi.com/wordpress" target="_blank">www.inexi.com</a></p>
</div>
<form action="options.php" method="post">
<?php settings_fields('easygalleryslider_options'); ?>
<p class="egs-heading">Advanced Options</p>
<p />
<input type="checkbox" id="" name="easygalleryslider[debug][imgerr]" value="off"<?php if ($egsoptions[debug][imgerr]=='off') echo ' checked="checked"'; ?> /> Disable broken image detection<br />
<input type="checkbox" id="" name="easygalleryslider[debug][tt]" value="off"<?php if ($egsoptions[debug][tt]=='off') echo ' checked="checked"'; ?> /> Disable TimThumb image resizing
<p />
<input type="checkbox" id="" name="easygalleryslider[debug][reset]" value="yes" /> <span style="color:red;">Reset all settings to default <small><strong>(immediate!)</strong></small></span>
<p />
<input type="hidden" name="easygalleryslider[debug][form]" value="true" />
<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" /> <em>(changes made to normal settings below will not be saved)</em>
</form>

</div>
<div id="egs-donate" class="egs-tabs">
	<div><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="hosted_button_id" value="E454JW67GKEKW">
	<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal">
	<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
	Any donations are greatly appreciated! Your donations help encourage further development of this plugin. Thank you! :)</div>
</div>
</div>
<div style="clear:both;"></div>
<form action="options.php" method="post">
<?php settings_fields('easygalleryslider_options'); ?>
<div id="egs-settings">
<?php do_settings_sections('easygalleryslider'); ?>
</div>
<p></p>
<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
</form></div>

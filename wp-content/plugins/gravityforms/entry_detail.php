<?php
class GFEntryDetail{
    public static function lead_detail_page(){
        global $wpdb;
        global $current_user;

        if(!GFCommon::ensure_wp_version())
            return;

        echo GFCommon::get_remote_message();

        $form = RGFormsModel::get_form_meta($_GET["id"]);
        $lead = RGFormsModel::get_lead($_GET["lid"]);

        if(!$lead){
            _e("OOps! We couldn't find your lead. Please try again", "gravityforms");
            return;
        }

        RGFormsModel::update_lead_property($lead["id"], "is_read", 1);

        $search_qs = empty($_GET["s"]) ? "" : "&s=" . $_GET["s"];
        $sort_qs = empty($_GET["sort"]) ? "" : "&sort=" . $_GET["sort"];
        $dir_qs = empty($_GET["dir"]) ? "" : "&dir=" . $_GET["dir"];
        $page_qs = empty($_GET["paged"]) ? "" : "&paged=" . absint($_GET["paged"]);

        switch($_POST["action"]){
            case "update" :
                check_admin_referer('gforms_save_entry', 'gforms_save_entry');
                RGFormsModel::save_lead($form, $lead);
                $lead = RGFormsModel::get_lead($_GET["lid"]);

            break;

            case "add_note" :
                check_admin_referer('gforms_update_note', 'gforms_update_note');
                $user_data = get_userdata($current_user->ID);
                RGFormsModel::add_note($lead["id"], $current_user->ID, $user_data->display_name, stripslashes($_POST["new_note"]));

                //emailing notes if configured
                if($_POST["gentry_email_notes_to"])
                {
                    $email_to = $_POST["gentry_email_notes_to"];
                    $email_from = $current_user->user_email;
                    $email_subject = stripslashes($_POST["gentry_email_subject"]);

                    $headers = "From: \"$email_from\" <$email_from> \r\n";
                    $result = wp_mail($email_to, $email_subject, stripslashes($_POST["new_note"]), $headers);
                }
            break;

            case "add_quick_note" :
                check_admin_referer('gforms_save_entry', 'gforms_save_entry');
                $user_data = get_userdata($current_user->ID);
                RGFormsModel::add_note($lead["id"], $current_user->ID, $user_data->display_name, stripslashes($_POST["quick_note"]));
            break;

            case "bulk" :
                check_admin_referer('gforms_update_note', 'gforms_update_note');
                if($_POST["bulk_action"] == "delete")
                    RGFormsModel::delete_notes($_POST["note"]);
            break;

            case "delete" :
                check_admin_referer('gforms_save_entry', 'gforms_save_entry');
                RGFormsModel::delete_lead($lead["id"]);
                ?>
                <div id="message" class="updated fade" style="background-color: rgb(255, 251, 204); margin-top:50px; padding:50px;">
                    <?php _e("Entry has been deleted.", "gravityforms"); ?> <a href="<?php echo esc_url("admin.php?page=gf_entries&view=entries&id=" . absint($form["id"]) . $search_qs . $sort_qs . $dir_qs . $page_qs) ?>"><?php _e("Back to entries list", "gravityforms"); ?></a>
                </div>
                <?php
                exit;
            break;
        }


        $mode = empty($_POST["screen_mode"]) ? "view" : $_POST["screen_mode"];

        ?>
        <link rel="stylesheet" href="<?php echo GFCommon::get_base_url()?>/css/admin.css" />
        <script type="text/javascript">


            function DeleteFile(leadId, fieldId){
                if(confirm(<?php _e("'Would you like to delete this file? \'Cancel\' to stop. \'OK\' to delete'", "gravityforms"); ?>)){

                    var mysack = new sack("<?php bloginfo( 'wpurl' ); ?>/wp-admin/admin-ajax.php" );
                    mysack.execute = 1;
                    mysack.method = 'POST';
                    mysack.setVar( "action", "rg_delete_file" );
                    mysack.setVar( "rg_delete_file", "<?php echo wp_create_nonce("rg_delete_file") ?>" );
                    mysack.setVar( "lead_id", leadId );
                    mysack.setVar( "field_id", fieldId );
                    mysack.encVar( "cookie", document.cookie, false );
                    mysack.onError = function() { alert('<?php _e("Ajax error while deleting field.", "gravityforms") ?>' )};
                    mysack.runAJAX();

                    return true;
                }
            }

            function EndDeleteFile(fieldId){
                jQuery('#preview_' + fieldId).hide();
                jQuery('#upload_' + fieldId).show('slow');
            }

            function ToggleShowEmptyFields(){
                if(jQuery("#gentry_display_empty_fields").is(":checked")){
                    createCookie("gf_display_empty_fields", true, 10000);
                    document.location = document.location.href;
                }
                else{
                    eraseCookie("gf_display_empty_fields");
                    document.location = document.location.href;
                }
            }

            function createCookie(name,value,days) {
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime()+(days*24*60*60*1000));
                    var expires = "; expires="+date.toGMTString();
                }
                else var expires = "";
                document.cookie = name+"="+value+expires+"; path=/";
            }

            function eraseCookie(name) {
                createCookie(name,"",-1);
            }

        </script>

        <form method="post" id="entry_form" enctype='multipart/form-data'>
            <?php wp_nonce_field('gforms_save_entry', 'gforms_save_entry') ?>
            <input type="hidden" name="action" id="action" value=""/>
            <input type="hidden" name="screen_mode" id="screen_mode" value="<?php echo $_POST["screen_mode"] ?>" />

            <div class="wrap">
            <img alt="<?php _e("Gravity Forms", "gravityforms") ?>" src="<?php echo GFCommon::get_base_url()?>/images/gravity-title-icon-32.png" style="float:left; margin:15px 7px 0 0;"/>
            <h2><?php _e("Entry #", "gravityforms"); ?><?php echo absint($lead["id"])?></h2>
            <a href="<?php echo esc_url("admin.php?page=gf_entries&view=entries&id=" . absint($form["id"]) . $search_qs . $sort_qs . $dir_qs . $page_qs) ?>"><?php _e("&laquo; back to entries list", "gravityforms"); ?></a>
            <div id="poststuff" class="metabox-holder has-right-sidebar">
                <div id="side-info-column" class="inner-sidebar">
                    <div id="submitdiv" class="stuffbox">
                        <h3>
                            <span class="hndle"><?php _e("Info", "gravityforms"); ?></span>
                        </h3>
                        <div class="inside">
                            <div id="submitcomment" class="submitbox">
                                <div id="minor-publishing" style="padding:10px;">
                                    <br/>
                                    <?php _e("Entry Id", "gravityforms"); ?>: <?php echo absint($lead["id"]) ?><br/><br/>
                                    <?php _e("Submitted on", "gravityforms"); ?>: <?php echo esc_html(GFCommon::format_date($lead["date_created"], false)) ?>
                                    <br/>
                                    <br/>
                                    <?php _e("User IP", "gravityforms"); ?>: <?php echo $lead["ip"] ?>
                                    <br/><br/>
                                    <?php _e("Embed Url", "gravityforms"); ?>: <a href="<?php echo esc_url($lead["source_url"]) ?>" target="_blank" alt="<?php echo esc_url($lead["source_url"]) ?>" title="<?php echo esc_url($lead["source_url"]) ?>">.../<?php echo esc_html(GFCommon::truncate_url($lead["source_url"]))?></a>
                                    <br/><br/>
                                    <?php
                                    if(!empty($lead["post_id"])){
                                        $post = get_post($lead["post_id"]);
                                        ?>
                                        <?php _e("Edit Post", "gravityforms"); ?>: <a href="post.php?action=edit&post=<?php echo absint($post->ID) ?>" alt="<?php _e("Click to edit post", "gravityforms"); ?>" title="<?php _e("Click to edit post", "gravityforms"); ?>"><?php echo esc_html($post->post_title) ?></a>
                                        <br/><br/>
                                        <?php
                                    }
                                    ?>

                                </div>
                                <div id="major-publishing-actions">
                                    <div id="delete-action">
                                        <?php
                                            if(GFCommon::current_user_can_any("gravityforms_delete_entries")){
                                                $delete_link = '<a class="submitdelete deletion" onclick="if ( confirm(\''. __("You are about to delete this entry. \'Cancel\' to stop, \'OK\' to delete.", "gravityforms") .'\') ) { jQuery(\'#action\').val(\'delete\'); jQuery(\'#entry_form\')[0].submit();} return false;" href="#">' . __("Delete", "gravityforms") . '</a>';
                                                echo apply_filters("gform_entrydetail_delete_link", $delete_link);
                                            }
                                        ?>
                                    </div>
                                    <div id="publishing-action">
                                        <?php
                                            if(GFCommon::current_user_can_any("gravityforms_edit_entries")){
                                                $button_text = $mode == "view" ? __("Edit Entry", "gravityforms") : __("Update Entry", "gravityforms");
                                                $button_click = $mode == "view" ? "jQuery('#screen_mode').val('edit');" : "jQuery('#action').val('update'); jQuery('#screen_mode').val('view');";
                                                $update_button = '<input class="button-primary" type="submit" tabindex="4" value="' . $button_text . '" name="save" onclick="' . $button_click . '"/>';
                                                echo apply_filters("gform_entrydetail_update_button", $update_button);
                                                if($mode == "edit")
                                                    echo '&nbsp;&nbsp;<input class="button" style="color:#bbb;" type="submit" tabindex="5" value="' . __("Cancel", "gravityforms") . '" name="cancel" onclick="jQuery(\'#screen_mode\').val(\'view\');"/>';
                                            }
                                        ?>
                                    </div>
                                    <br/> <br/><br/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if(GFCommon::current_user_can_any("gravityforms_edit_entry_notes")) { ?>
                        <!-- start side notes -->
                        <div class="postbox" id="tagsdiv-post_tag">
                            <h3 style="cursor:default;"><span>Quick Note</span></h3>
                            <div class="inside">
                                <div id="post_tag" class="tagsdiv">
                                    <div>
                                        <span>
                                            <textarea name="quick_note" style="width:99%; height:180px; margin-bottom:4px;"></textarea>
                                            <input type="submit" name="add_quick_note" value="<?php _e("Add Note", "gravityforms") ?>" class="button" style="width:60px;" onclick="jQuery('#action').val('add_quick_note');"/>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <!-- end side notes -->
                   <?php } ?>

                   <!-- begin print button -->
                   <div class="detail-view-print">
                       <a href="javascript:;" onclick="var notes_qs = jQuery('#gform_print_notes').is(':checked') ? '&notes=1' : ''; var url='<?php echo GFCommon::get_base_url() ?>/print-entry.php?fid=<?php echo $form['id'] ?>&lid=<?php echo $lead['id']?>' + notes_qs; window.open (url,'printwindow');" class="button">Print</a>
                       <?php if(GFCommon::current_user_can_any("gravityforms_view_entry_notes")) { ?>
                           <input type="checkbox" name="print_notes" value="print_notes" checked="checked" id="gform_print_notes"/>
                           <label for="print_notes">include notes</label>
                       <?php } ?>
                   </div>
                   <!-- end print button -->

                </div>

                <div id="post-body" class="has-sidebar">
                    <div id="post-body-content" class="has-sidebar-content">
                        <?php
                        if($mode == "view")
                            self::lead_detail_grid($form, $lead, true);
                        else
                            self::lead_detail_edit($form, $lead);
                        ?>

                        <?php if(GFCommon::current_user_can_any("gravityforms_view_entry_notes")) { ?>
                            <div id="namediv" class="stuffbox">
                                <h3>
                                    <label for="name"><?php _e("Notes", "gravityforms"); ?></label>
                                </h3>

                                <form method="post">
                                    <?php wp_nonce_field('gforms_update_note', 'gforms_update_note') ?>
                                    <div class="inside">
                                        <?php
                                        $notes = RGFormsModel::get_lead_notes($lead["id"]);

                                        //getting email values
                                        $email_fields = GFCommon::get_email_fields($form);
                                        $emails = array();

                                        foreach($email_fields as $email_field){
                                            if(!empty($lead[$email_field["id"]])){
                                                $emails[] = $lead[$email_field["id"]];
                                            }
                                        }
                                        //displaying notes grid
                                        $subject = !empty($form["autoResponder"]["subject"]) ? "RE: " . GFCommon::replace_variables($form["autoResponder"]["subject"], $form, $lead) : "";
                                        self::notes_grid($notes, true, $emails, $subject);
                                        ?>
                                    </div>
                                </form>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <?php

         if($_POST["action"] == "update"){
            ?>
            <div class="updated fade" style="padding:6px;">
                <?php _e("Entry Updated.", "gravityforms"); ?>
            </div>
            <?php
        }
    }

    public static function lead_detail_edit($form, $lead){
        ?>
        <div id="namediv" class="stuffbox">
            <h3>
                <label for="name"><?php _e("Details", "gravityforms"); ?></label>
            </h3>
            <div class="inside">
                <table class="form-table entry-details">
                    <tbody>
                    <?php
                    foreach($form["fields"] as $field){
                        switch(RGFormsModel::get_input_type($field)){
                            case "section" :
                                ?>
                                <tr valign="top">
                                    <td class="detail-view">
                                        <div style="margin-bottom:10px; border-bottom:1px dotted #ccc;"><h2 class="detail_gsection_title"><?php echo esc_html(GFCommon::get_label($field))?></h2></div>
                                    </td>
                                </tr>
                                <?php
                            break;

                            case "captcha":
                                //ignore captcha field
                            break;

                            default :
                                $value = RGFormsModel::get_lead_field_value($lead, $field);
                                ?>
                                <tr valign="top">
                                    <td class="detail-view">
                                        <label class="detail-label"><?php echo esc_html(GFCommon::get_label($field))?></label>
                                        <?php echo GFCommon::get_field_input($field, $value, $lead["id"])?>
                                    </td>
                                </tr>
                                <?php
                            break;
                        }

                    }
                    ?>
                    </tbody>
                </table>
                <br/>
            </div>
        </div>
        <?php
    }

    public static function notes_grid($notes, $is_editable, $emails = null, $autoresponder_subject=""){
        if(sizeof($notes) > 0 && $is_editable && GFCommon::current_user_can_any("gravityforms_edit_entry_notes")){
            ?>
            <div class="alignleft actions" style="padding:3px 0;">
                <label class="hidden" for="bulk_action"><?php _e(" Bulk action", "gravityforms") ?></label>
                <select name="bulk_action" id="bulk_action">
                    <option value=''><?php _e(" Bulk action ", "gravityforms") ?></option>
                    <option value='delete'><?php _e("Delete", "gravityforms") ?></option>
                </select>
                <?php
                $apply_button = '<input type="submit" class="button" value="' . __("Apply", "gravityforms") . '" onclick="jQuery(\'#action\').val(\'bulk\');" style="width: 50px;" />';
                echo apply_filters("gform_notes_apply_button", $apply_button);
                ?>
            </div>
            <?php
        }
        ?>
        <table class="widefat fixed entry-detail-notes" cellspacing="0">
            <?php
            if(!$is_editable){
            ?>
            <thead>
                <tr>
                    <th id="notes">Notes</th>
                </tr>
            </thead>
            <?php
            }
            ?>
            <tbody id="the-comment-list" class="list:comment">
            <?php
            $count = 0;
            $notes_count = sizeof($notes);
            foreach($notes as $note){
                $count++;
                $is_last = $count >= $notes_count ? true : false;
                ?>
                <tr valign="top">
                    <?php
                    if($is_editable && GFCommon::current_user_can_any("gravityforms_edit_entry_notes")){
                    ?>
                        <th class="check-column" scope="row" style="padding:9px 3px 0 0">
                            <input type="checkbox" value="<?php echo $note->id ?>" name="note[]"/>
                        </th>
                        <td colspan="2">
                    <?php
                    }
                    else{
                    ?>
                        <td class="entry-detail-note<?php echo $is_last ? " lastrow" : "" ?>">
                    <?php
                    }
                    ?>
                            <div style="margin-top:4px;">
                                <div class="note-avatar"><?php echo get_avatar($note->user_id, 48);?></div>
                                <h6 class="note-author"> <?php echo esc_html($note->user_name)?></h6>
                                <p style="line-height:130%; text-align:left; margin-top:3px;"><a href="mailto:<?php echo esc_attr($note->user_email)?>"><?php echo esc_html($note->user_email) ?></a><br />
                                <?php _e("added on", "gravityforms"); ?> <?php echo esc_html(GFCommon::format_date($note->date_created, false)) ?></p>
                            </div>
                            <div class="detail-note-content"><?php echo esc_html($note->value) ?></div>
                        </td>

                </tr>
                <?php
            }
            if($is_editable && GFCommon::current_user_can_any("gravityforms_edit_entry_notes")){
                ?>
                <tr>
                    <td colspan="3" style="padding:10px;" class="lastrow">
                        <textarea name="new_note" style="width:100%; height:50px; margin-bottom:4px;"></textarea>
                        <?php
                        $note_button = '<input type="submit" name="add_note" value="' . __("Add Note", "gravityforms") . '" class="button" style="width:60px;" onclick="jQuery(\'#action\').val(\'add_note\');"/>';
                        echo apply_filters("gform_addnote_button", $note_button);

                        if(!empty($emails)){ ?>
                            &nbsp;&nbsp;
                            <span>
                                <select name="gentry_email_notes_to" onchange="if(jQuery(this).val() != '') {jQuery('#gentry_email_subject_container').css('display', 'inline');} else{jQuery('#gentry_email_subject_container').css('display', 'none');}">
                                    <option value=""><?php _e("Also email this note to", "gravityforms") ?></option>
                                    <?php foreach($emails as $email){ ?>
                                        <option value="<?php echo $email ?>"><?php echo $email ?></option>
                                    <?php } ?>
                                </select>
                                &nbsp;&nbsp;

                                <span id='gentry_email_subject_container' style="display:none;">
                                    <label for="gentry_email_subject"><?php _e("Subject:", "gravityforms") ?></label>
                                    <input type="text" name="gentry_email_subject" id="gentry_email_subject" value="<?php echo $autoresponder_subject ?>" style="width:35%"/>
                                </span>
                            </span>
                        <?php } ?>
                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
        <?php
    }

    public static function lead_detail_grid($form, $lead, $allow_display_empty_fields=false){
        if($allow_display_empty_fields){
            $display_empty_fields = $_COOKIE["gf_display_empty_fields"];
        }
        ?>
        <table cellspacing="0" class="widefat fixed entry-detail-view">
            <thead>
                <tr>
                    <th id="details">
                    <?php echo $form["title"]?> : <?php _e("Entry # ", "gravityforms") ?> <?php echo $lead["id"] ?>
                    </th>
                    <th style="width:140px; font-size:10px; text-align: right;">
                    <?php
                        if($allow_display_empty_fields){
                            ?>
                            <input type="checkbox" id="gentry_display_empty_fields" <?php echo $display_empty_fields ? "checked='checked'" : "" ?> onclick="ToggleShowEmptyFields();"/>&nbsp;&nbsp;<label for="gentry_display_empty_fields">show empty fields</label>
                            <?php
                        }
                        ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 0;
                $field_count = sizeof($form["fields"]);
                foreach($form["fields"] as $field){
                    $count++;
                    $is_last = $count >= $field_count ? true : false;

                    switch(RGFormsModel::get_input_type($field)){
                        case "section" :
                            ?>
                            <tr>
                                <td colspan="2" class="entry-view-section-break<?php echo $is_last ? " lastrow" : ""?>"><?php echo esc_html(GFCommon::get_label($field))?></td>
                            </tr>
                            <?php
                        break;

                        case "captcha":
                            //ignore captcha field
                        break;

                        default :
                            $value = RGFormsModel::get_lead_field_value($lead, $field);
                            $display_value = GFCommon::get_lead_field_display($field, $value);
                            if($display_empty_fields || !empty($display_value)){
                                ?>
                                <tr>
                                    <td colspan="2" class="entry-view-field-name"><?php echo esc_html(GFCommon::get_label($field))?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="entry-view-field-value<?php echo $is_last ? " lastrow" : ""?>"><?php echo empty($display_value) ? "&nbsp;" : $display_value ?></td>
                                </tr>
                                <?php
                            }
                        break;
                    }
                }
                ?>
            </tbody>
        </table>
        <?php
    }
}
?>
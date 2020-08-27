<?php
if (!defined("ABSPATH")) {
    exit();
}
?>
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wv_get_avatars">
    <div class="wpd-opt-name">
        <label for="wv_get_avatars"><?php echo $setting["options"]["wv_get_avatars"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wv_get_avatars"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->wvOptions["wv_get_avatars"] == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[wv_get_avatars]" id="wv_get_avatars">
            <label for="wv_get_avatars"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wv_real_time">
    <div class="wpd-opt-name">
        <label for="wv_real_time"><?php echo $setting["options"]["wv_real_time"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wv_real_time"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->wvOptions["wv_real_time"] == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[wv_real_time]" id="wv_real_time">
            <label for="wv_real_time"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<?php $readMoreChecked = $setting["values"]->wvOptions["wv_read_more"] == 1; ?>
<div class="wpd-opt-row" data-wpd-opt="wv_read_more">
    <div class="wpd-opt-name">
        <label for="wv_read_more"><?php echo $setting["options"]["wv_read_more"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wv_read_more"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($readMoreChecked) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[wv_read_more]" id="wv_read_more">
            <label for="wv_read_more"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wv_read_more_get_avatar" <?php echo $readMoreChecked ? "" : "style='display:none;'"; ?>>
    <div class="wpd-opt-name">
        <label for="wv_read_more_get_avatar"><?php echo $setting["options"]["wv_read_more_get_avatar"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wv_read_more_get_avatar"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->wvOptions["wv_read_more_get_avatar"] == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[wv_read_more_get_avatar]" id="wv_read_more_get_avatar">
            <label for="wv_read_more_get_avatar"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wv_count">
    <div class="wpd-opt-name">
        <label for="wv_count"><?php echo $setting["options"]["wv_count"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wv_count"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="number" id="wv_count" max="25" min="1" name="<?php echo $setting["values"]->tabKey; ?>[wv_count]" value="<?php echo $setting["values"]->wvOptions["wv_count"]; ?>" style="width: 80px;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wv_count_all">
    <div class="wpd-opt-name">
        <label for="wv_count_all"><?php echo $setting["options"]["wv_count_all"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wv_count_all"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="number" id="wv_count_all" min="1" name="<?php echo $setting["values"]->tabKey; ?>[wv_count_all]" value="<?php echo $setting["values"]->wvOptions["wv_count_all"]; ?>" style="width: 80px;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wv_level">
    <div class="wpd-opt-input" style="width: calc(100% - 40px);">
        <h2 style="margin-bottom: 0px;font-size: 15px; color: #555;"><?php echo $setting["options"]["wv_level"]["label"] ?></h2>
        <p class="wpd-desc"><?php echo $setting["options"]["wv_level"]["description"] ?></p>
        <hr />
        <div style="width:100%;">
            <div class="wv_level_box">
                <?php $wvLvl1IconColor = isset($setting["values"]->wvOptions["wv_level"][1]["icon"]["color"]) ? $setting["values"]->wvOptions["wv_level"][1]["icon"]["color"] : "#0CD85D"; ?>
                <div style="text-align:center;">
                    <span class="wv-icon-preview">
                        <i class="<?php echo $setting["values"]->wvOptions["wv_level"][1]["icon"]["value"]; ?>" style="color:<?php echo $wvLvl1IconColor; ?>"></i>
                    </span>
                </div>
                <div>                  
                    <input placeholder="Total Votes" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][1][vote][value]" value="<?php echo $setting["values"]->wvOptions["wv_level"][1]["vote"]["value"]; ?>" type="number" />
                    <p style="font-size:12px; color:#999; margin:0px;"><?php _e("Total count of votes", "wpdiscuz_likers"); ?></p>
                </div>
                <div>
                    <input class="wv-iconpicker" placeholder="Badge Icon" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][1][icon][value]" value="<?php echo $setting["values"]->wvOptions["wv_level"][1]["icon"]["value"]; ?>" type="text" /> 
                    <div class="wv-badges-inline">
                        <input type="checkbox" id="wv_level_1_icon" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][1][icon][enable]" value="1" <?php checked($setting["values"]->wvOptions["wv_level"][1]["icon"]["enable"] == 1); ?> /> 
                        <label for="wv_level_1_icon"><?php _e("Enable", "wpdiscuz_likers"); ?></label>
                    </div>
                </div>
                <div>
                    <input placeholder="Custom Label" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][1][label][value]" value="<?php echo $setting["values"]->wvOptions["wv_level"][1]["label"]["value"]; ?>" type="text" /> 
                    <div class="wv-badges-inline">
                        <input type="checkbox" id="wv_level_1_label" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][1][label][enable]" value="1" <?php checked($setting["values"]->wvOptions["wv_level"][1]["label"]["enable"] == 1); ?>/> 
                        <label for="wv_level_1_label"><?php _e("Enable", "wpdiscuz_likers"); ?></label>
                    </div>
                </div>
                <div><input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $wvLvl1IconColor; ?>" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][1][icon][color]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz_likers"); ?>"/></div>
            </div>
            <div class="wv_level_box">
                <?php $wvLvl2IconColor = isset($setting["values"]->wvOptions["wv_level"][2]["icon"]["color"]) ? $setting["values"]->wvOptions["wv_level"][2]["icon"]["color"] : "#E5D600"; ?>
                <div style="text-align:center;">
                    <span class="wv-icon-preview">
                        <i class="<?php echo $setting["values"]->wvOptions["wv_level"][2]["icon"]["value"]; ?>" style="color:<?php echo $wvLvl2IconColor; ?>"></i>
                    </span>
                </div>
                <div>
                    <input placeholder="<?php _e("Total Votes", "wpdiscuz_likers"); ?>" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][2][vote][value]" value="<?php echo $setting["values"]->wvOptions["wv_level"][2]["vote"]["value"]; ?>" type="number" />
                    <p style="font-size:12px; color:#999; margin:0px;"><?php _e("Total count of votes", "wpdiscuz_likers"); ?></p>
                </div>
                <div>
                    <input class="wv-iconpicker" placeholder="<?php _e("Badge Icon", "wpdiscuz_likers"); ?>" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][2][icon][value]" value="<?php echo $setting["values"]->wvOptions["wv_level"][2]["icon"]["value"]; ?>" type="text" /> 
                    <div class="wv-badges-inline">
                        <input type="checkbox" id="wv_level_2_icon" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][2][icon][enable]" value="1" <?php checked($setting["values"]->wvOptions["wv_level"][2]["icon"]["enable"] == 1); ?>/>
                        <label for="wv_level_2_icon"><?php _e("Enable", "wpdiscuz_likers"); ?></label>
                    </div>
                </div>
                <div>
                    <input placeholder="<?php _e("Custom Label", "wpdiscuz_likers"); ?>" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][2][label][value]" value="<?php echo $setting["values"]->wvOptions["wv_level"][2]["label"]["value"]; ?>" type="text" />
                    <div class="wv-badges-inline">
                        <input type="checkbox" id="wv_level_2_label" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][2][label][enable]" value="1" <?php checked($setting["values"]->wvOptions["wv_level"][2]["label"]["enable"] == 1); ?>/>
                        <label for="wv_level_2_label"><?php _e("Enable", "wpdiscuz_likers"); ?></label>
                    </div>
                </div>
                <div><input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $wvLvl2IconColor; ?>" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][2][icon][color]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz_likers"); ?>"/></div>
            </div>
            <div class="wv_level_box">
                <?php $wvLvl3IconColor = isset($setting["values"]->wvOptions["wv_level"][3]["icon"]["color"]) ? $setting["values"]->wvOptions["wv_level"][3]["icon"]["color"] : "#FF812D"; ?>
                <div style="text-align:center;">
                    <span class="wv-icon-preview">
                        <i class="<?php echo $setting["values"]->wvOptions["wv_level"][3]["icon"]["value"]; ?>" style="color:<?php echo $wvLvl3IconColor; ?>"></i>
                    </span>
                </div>
                <div>
                    <input placeholder="<?php _e("Total Votes", "wpdiscuz_likers"); ?>" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][3][vote][value]" value="<?php echo $setting["values"]->wvOptions["wv_level"][3]["vote"]["value"]; ?>" type="number" />
                    <p style="font-size:12px; color:#999; margin:0px;"><?php _e("Total count of votes", "wpdiscuz_likers"); ?></p>
                </div>
                <div>
                    <input class="wv-iconpicker" placeholder="<?php _e("Badge Icon", "wpdiscuz_likers"); ?>" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][3][icon][value]" value="<?php echo $setting["values"]->wvOptions["wv_level"][3]["icon"]["value"]; ?>" type="text" /> 
                    <div class="wv-badges-inline">
                        <input type="checkbox" id="wv_level_3_icon" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][3][icon][enable]" value="1" <?php checked($setting["values"]->wvOptions["wv_level"][3]["icon"]["enable"] == 1); ?>/> 
                        <label for="wv_level_3_icon"><?php _e("Enable", "wpdiscuz_likers"); ?></label>
                    </div>
                </div>
                <div>
                    <input placeholder="<?php _e("Custom Label", "wpdiscuz_likers"); ?>" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][3][label][value]" value="<?php echo $setting["values"]->wvOptions["wv_level"][3]["label"]["value"]; ?>" type="text" />
                    <div class="wv-badges-inline">
                        <input type="checkbox" id="wv_level_3_label" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][3][label][enable]" value="1" <?php checked($setting["values"]->wvOptions["wv_level"][3]["label"]["enable"] == 1); ?>/> 
                        <label for="wv_level_3_label"><?php _e("Enable", "wpdiscuz_likers"); ?></label>
                    </div>
                </div>
                <div><input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $wvLvl3IconColor; ?>" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][3][icon][color]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz_likers"); ?>"/></div>
            </div>
            <div class="wv_level_box">
                <?php $wvLvl4IconColor = isset($setting["values"]->wvOptions["wv_level"][4]["icon"]["color"]) ? $setting["values"]->wvOptions["wv_level"][4]["icon"]["color"] : "#43A6DF"; ?>
                <div style="text-align:center;">
                    <span class="wv-icon-preview">
                        <i class="<?php echo $setting["values"]->wvOptions["wv_level"][4]["icon"]["value"]; ?>" style="color:<?php echo $wvLvl4IconColor; ?>"></i>
                    </span>
                </div>
                <div>
                    <input placeholder="<?php _e("Total Votes", "wpdiscuz_likers"); ?>" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][4][vote][value]" value="<?php echo $setting["values"]->wvOptions["wv_level"][4]["vote"]["value"]; ?>" type="number" />
                    <p style="font-size:12px; color:#999; margin:0px;"><?php _e("Total count of votes", "wpdiscuz_likers"); ?></p>
                </div>
                <div>
                    <input class="wv-iconpicker" placeholder="<?php _e("Badge Icon", "wpdiscuz_likers"); ?>" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][4][icon][value]" value="<?php echo $setting["values"]->wvOptions["wv_level"][4]["icon"]["value"]; ?>" type="text" />
                    <div class="wv-badges-inline">
                        <input type="checkbox" id="wv_level_4_icon" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][4][icon][enable]" value="1" <?php checked($setting["values"]->wvOptions["wv_level"][4]["icon"]["enable"] == 1); ?>/> 
                        <label for="wv_level_4_icon"><?php _e("Enable", "wpdiscuz_likers"); ?></label>
                    </div>
                </div>
                <div>
                    <input placeholder="<?php _e("Custom Label", "wpdiscuz_likers"); ?>" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][4][label][value]" value="<?php echo $setting["values"]->wvOptions["wv_level"][4]["label"]["value"]; ?>" type="text" />
                    <div class="wv-badges-inline">
                        <input type="checkbox" id="wv_level_4_label" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][4][label][enable]" value="1" <?php checked($setting["values"]->wvOptions["wv_level"][4]["label"]["enable"] == 1); ?>/>
                        <label for="wv_level_4_label"><?php _e("Enable", "wpdiscuz_likers"); ?></label>
                    </div>
                </div>
                <div><input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $wvLvl4IconColor; ?>" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][4][icon][color]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz_likers"); ?>"/></div>
            </div>
            <div class="wv_level_box">
                <?php $wvLvl5IconColor = isset($setting["values"]->wvOptions["wv_level"][5]["icon"]["color"]) ? $setting["values"]->wvOptions["wv_level"][5]["icon"]["color"] : "#E04A47"; ?>
                <div style="text-align:center;">
                    <span class="wv-icon-preview">
                        <i class="<?php echo $setting["values"]->wvOptions["wv_level"][5]["icon"]["value"]; ?>" style="color:<?php echo $wvLvl5IconColor; ?>;"></i>
                    </span>
                </div>
                <div>
                    <input placeholder="<?php _e("Total Votes", "wpdiscuz_likers"); ?>" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][5][vote][value]" value="<?php echo $setting["values"]->wvOptions["wv_level"][5]["vote"]["value"]; ?>" type="number" />
                    <p style="font-size:12px; color:#999; margin:0px;"><?php _e("Total count of votes", "wpdiscuz_likers"); ?></p>
                </div>
                <div>
                    <input class="wv-iconpicker" placeholder="<?php _e("Badge Icon", "wpdiscuz_likers"); ?>" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][5][icon][value]" value="<?php echo $setting["values"]->wvOptions["wv_level"][5]["icon"]["value"]; ?>" type="text" />
                    <div class="wv-badges-inline">
                        <input type="checkbox" id="wv_level_5_icon" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][5][icon][enable]" value="1" <?php checked($setting["values"]->wvOptions["wv_level"][5]["icon"]["enable"] == 1); ?>/>
                        <label for="wv_level_5_icon"><?php _e("Enable", "wpdiscuz_likers"); ?></label>
                    </div>
                </div>
                <div>
                    <input placeholder="<?php _e("Custom Label", "wpdiscuz_likers"); ?>" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][5][label][value]" value="<?php echo $setting["values"]->wvOptions["wv_level"][5]["label"]["value"]; ?>" type="text" />
                    <div class="wv-badges-inline">
                        <input type="checkbox" id="wv_level_5_label" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][5][label][enable]" value="1" <?php checked($setting["values"]->wvOptions["wv_level"][5]["label"]["enable"] == 1); ?>/>
                        <label for="wv_level_5_label"><?php _e("Enable", "wpdiscuz_likers"); ?></label>
                    </div>
                </div>
                <div><input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $wvLvl5IconColor; ?>" name="<?php echo $setting["values"]->tabKey; ?>[wv_level][5][icon][color]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz_likers"); ?>"/></div>
            </div>
            <div class="wpd-clear"></div>
        </div>
    </div>
</div>
<!-- Option end -->
<div class="wpd-subtitle">
    <?php _e("Background and Colors", "wpdiscuz_likers") ?>
</div>
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wv_background_color">
    <div class="wpd-opt-name">
        <label for="wv_background_color"><?php echo $setting["options"]["wv_background_color"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wv_background_color"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->wvOptions["wv_background_color"]; ?>" id="wv_background_color" name="<?php echo $setting["values"]->tabKey; ?>[wv_background_color]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->wvOptions["wv_background_color"]; ?>"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wv_border_color">
    <div class="wpd-opt-name">
        <label for="wv_border_color"><?php echo $setting["options"]["wv_border_color"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wv_border_color"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->wvOptions["wv_border_color"]; ?>" id="wv_border_color" name="<?php echo $setting["values"]->tabKey; ?>[wv_border_color]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->wvOptions["wv_border_color"]; ?>"/>
    </div>
</div>
<!-- Option end -->
<div class="wpd-subtitle">
    <?php _e("Front-end Phrases", "wpdiscuz_likers") ?>
</div>
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wv_guests">
    <div class="wpd-opt-name">
        <label for="wv_guests"><?php echo $setting["options"]["wv_guests"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wv_guests"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[wv_guests]" value="<?php echo $setting["values"]->wvPhrases["wv_guests"]; ?>" id="wv_guests" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="wv_view_all">
    <div class="wpd-opt-name">
        <label for="wv_view_all"><?php echo $setting["options"]["wv_view_all"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["wv_view_all"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[wv_view_all]" value="<?php echo $setting["values"]->wvPhrases["wv_view_all"]; ?>" id="wv_view_all" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="recountVotes">
    <div class="wpd-opt-name">
        <label for="recountVotes"><?php echo $setting["options"]["recountVotes"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["recountVotes"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <button type="submit" class="button button-secondary recount-user-votes" title="<?php _e("Start Count", "wpdiscuz_likers"); ?>">
            <?php _e("Recount user votes", "wpdiscuz_likers"); ?>&nbsp;
            <i class="fas wc-hidden"></i>
        </button>
        <span class="recount-user-votes-import-progress">&nbsp;</span>
        <input type="hidden" name="recount-user-votes-start-id" value="0" class="recount-user-votes-start-id"/>
        <input type="hidden" name="recount-user-votes-count" value="<?php echo count($setting["values"]->dbmanager->getUsersCountWithComments(0)); ?>" class="recount-user-votes-count"/>
        <input type="hidden" name="recount-user-votes-step" value="0" class="recount-user-votes-step"/>
        <?php wp_nonce_field("wv_recount", "wv_recount_nonce"); ?>
    </div>
</div>
<!-- Option end -->
<?php
if (!defined("ABSPATH")) {
    exit();
}
?>
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="enableOnlineChecking">
    <div class="wpd-opt-name">
        <label for="enableOnlineChecking"><?php echo $setting["options"]["enableOnlineChecking"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["enableOnlineChecking"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->enableOnlineChecking == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[enableOnlineChecking]" id="enableOnlineChecking">
            <label for="enableOnlineChecking"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="checkFrequency">
    <div class="wpd-opt-name">
        <label for="checkFrequency"><?php echo $setting["options"]["checkFrequency"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["checkFrequency"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="number" id="checkFrequency" min="0" name="<?php echo $setting["values"]->tabKey; ?>[checkFrequency]" value="<?php echo $setting["values"]->checkFrequency; ?>" style="width: 80px;"/>
        <select name="<?php echo $setting["values"]->tabKey; ?>[checkFrequencyType]">
            <option value="s" <?php selected("s" == $setting["values"]->checkFrequencyType); ?>><?php _e("second(s)", "wpdiscuz-ou"); ?></option>
            <option value="m" <?php selected("m" == $setting["values"]->checkFrequencyType); ?>><?php _e("minute(s)", "wpdiscuz-ou"); ?></option>
        </select>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="isShowNotificationPopup">
    <div class="wpd-opt-name">
        <label for="isShowNotificationPopup"><?php echo $setting["options"]["isShowNotificationPopup"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["isShowNotificationPopup"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->isShowNotificationPopup == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[isShowNotificationPopup]" id="isShowNotificationPopup">
            <label for="isShowNotificationPopup"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="notificationPopupTimeout">
    <div class="wpd-opt-name">
        <label for="notificationPopupTimeout"><?php echo $setting["options"]["notificationPopupTimeout"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["notificationPopupTimeout"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="number" id="notificationPopupTimeout" min="0" name="<?php echo $setting["values"]->tabKey; ?>[notificationPopupTimeout]" value="<?php echo $setting["values"]->notificationPopupTimeout; ?>" style="width: 80px;"/>&nbsp; <?php _e("seconds", "wpdiscuz-ou"); ?>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="notificationPopupPosition">
    <div class="wpd-opt-name">
        <label for="notificationPopupPosition"><?php echo $setting["options"]["notificationPopupPosition"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["notificationPopupPosition"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <select name="<?php echo $setting["values"]->tabKey; ?>[notificationPopupPosition]">
            <option value="top-left" <?php selected($setting["values"]->notificationPopupPosition == "top-left"); ?>><?php _e("Top left", "wpdiscuz-ou"); ?></option>
            <option value="top-right" <?php selected($setting["values"]->notificationPopupPosition == "top-right"); ?>><?php _e("Top right", "wpdiscuz-ou"); ?></option>
            <option value="bottom-right" <?php selected($setting["values"]->notificationPopupPosition == "bottom-right"); ?>><?php _e("Bottom right", "wpdiscuz-ou"); ?></option>
            <option value="bottom-left" <?php selected($setting["values"]->notificationPopupPosition == "bottom-left"); ?>><?php _e("Bottom left", "wpdiscuz-ou"); ?></option>                            
        </select>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="notificationItemBG">
    <div class="wpd-opt-name">
        <label for="notificationItemBG"><?php echo $setting["options"]["notificationItemBG"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["notificationItemBG"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->notificationItemBG; ?>" id="notificationItemBG" name="<?php echo $setting["values"]->tabKey; ?>[notificationItemBG]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->notificationItemBG; ?>"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="notificationItemTextColor">
    <div class="wpd-opt-name">
        <label for="notificationItemTextColor"><?php echo $setting["options"]["notificationItemTextColor"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["notificationItemTextColor"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->notificationItemTextColor; ?>" id="notificationItemTextColor" name="<?php echo $setting["values"]->tabKey; ?>[notificationItemTextColor]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->notificationItemTextColor; ?>"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="onlineStatusColor">
    <div class="wpd-opt-name">
        <label for="onlineStatusColor"><?php echo $setting["options"]["onlineStatusColor"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["onlineStatusColor"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->onlineStatusColor; ?>" id="onlineStatusColor" name="<?php echo $setting["values"]->tabKey; ?>[onlineStatusColor]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->onlineStatusColor; ?>"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="offlineStatusColor">
    <div class="wpd-opt-name">
        <label for="offlineStatusColor"><?php echo $setting["options"]["offlineStatusColor"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["offlineStatusColor"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" class="wpdiscuz-color-picker regular-text" value="<?php echo $setting["values"]->offlineStatusColor; ?>" id="offlineStatusColor" name="<?php echo $setting["values"]->tabKey; ?>[offlineStatusColor]" placeholder="<?php _e("Example: #00FF00", "wpdiscuz"); ?>" style="margin:1px;padding:3px 5px; width:90%;background-color:<?php echo $setting["values"]->offlineStatusColor; ?>"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="showStatusLabel">
    <div class="wpd-opt-name">
        <label for="showStatusLabel"><?php echo $setting["options"]["showStatusLabel"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["showStatusLabel"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <div class="wpd-switcher">
            <input type="checkbox" <?php checked($setting["values"]->showStatusLabel == 1) ?> value="1" name="<?php echo $setting["values"]->tabKey; ?>[showStatusLabel]" id="showStatusLabel">
            <label for="showStatusLabel"></label>
        </div>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="phraseUserIsOnline">
    <div class="wpd-opt-name">
        <label for="phraseUserIsOnline"><?php echo $setting["options"]["phraseUserIsOnline"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["phraseUserIsOnline"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[phraseUserIsOnline]" value="<?php echo $setting["values"]->phraseUserIsOnline; ?>" id="phraseUserIsOnline" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="phraseUserLastComment">
    <div class="wpd-opt-name">
        <label for="phraseUserLastComment"><?php echo $setting["options"]["phraseUserLastComment"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["phraseUserLastComment"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[phraseUserLastComment]" value="<?php echo $setting["values"]->phraseUserLastComment; ?>" id="phraseUserLastComment" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="phraseReadMore">
    <div class="wpd-opt-name">
        <label for="phraseReadMore"><?php echo $setting["options"]["phraseReadMore"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["phraseReadMore"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[phraseReadMore]" value="<?php echo $setting["values"]->phraseReadMore; ?>" id="phraseReadMore" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="phraseOnline">
    <div class="wpd-opt-name">
        <label for="phraseOnline"><?php echo $setting["options"]["phraseOnline"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["phraseOnline"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[phraseOnline]" value="<?php echo $setting["values"]->phraseOnline; ?>" id="phraseOnline" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
<!-- Option start -->
<div class="wpd-opt-row" data-wpd-opt="phraseOffline">
    <div class="wpd-opt-name">
        <label for="phraseOffline"><?php echo $setting["options"]["phraseOffline"]["label"] ?></label>
        <p class="wpd-desc"><?php echo $setting["options"]["phraseOffline"]["description"] ?></p>
    </div>
    <div class="wpd-opt-input">
        <input type="text" name="<?php echo $setting["values"]->tabKey; ?>[phraseOffline]" value="<?php echo $setting["values"]->phraseOffline; ?>" id="phraseOffline" style="margin:1px;padding:3px 5px; width:90%;"/>
    </div>
</div>
<!-- Option end -->
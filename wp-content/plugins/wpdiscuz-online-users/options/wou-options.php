<?php

if (!defined("ABSPATH")) {
    exit();
}

class WOUOptions implements WOUConstants {

    public $enableOnlineChecking;
    public $checkFrequency;
    public $checkFrequencyType;
    public $keepOnlineTime;
    public $isShowNotificationPopup;
    public $notificationPopupTimeout;
    public $notificationPopupPosition;
    public $notificationItemBG;
    public $notificationItemTextColor;
    public $onlineStatusColor;
    public $offlineStatusColor;
    public $showStatusLabel;
    public $phraseUserIsOnline;
    public $phraseUserLastComment;
    public $phraseReadMore;
    public $phraseOnline;
    public $phraseOffline;
    public $currentBlogId;
    public $tabKey = "wou";

    public function __construct() {
        $this->addOptions();
        $options = maybe_unserialize(get_option(self::OPTION_MAIN));
        $this->initOptions($options);

        add_action("wpdiscuz_save_options", [&$this, "saveOptions"]);
        add_action("wpdiscuz_reset_options", [&$this, "resetOptions"]);
        add_filter("wpdiscuz_settings", [&$this, "settingsArray"]);
    }

    public function addOptions() {
        $options = [
            "enableOnlineChecking" => 0, // seconds
            "checkFrequency" => 60, // seconds
            "checkFrequencyType" => "s", // seconds
            "keepOnlineTime" => 120, // seconds
            "isShowNotificationPopup" => 1,
            "notificationPopupTimeout" => 10, // seconds
            "notificationPopupPosition" => "bottom-right",
            "notificationItemBG" => "#eee",
            "notificationItemTextColor" => "#333",
            "onlineStatusColor" => "#00b38f",
            "offlineStatusColor" => "#ca3c3c",
            "showStatusLabel" => 1,
            "phraseUserIsOnline" => __("is online", "wpdiscuz-ou"),
            "phraseUserLastComment" => __("Last Comment", "wpdiscuz-ou"),
            "phraseReadMore" => __("read this comment &raquo;", "wpdiscuz-ou"),
            "phraseOnline" => __("Online", "wpdiscuz-ou"),
            "phraseOffline" => __("Offline", "wpdiscuz-ou"),
        ];
        add_option(self::OPTION_MAIN, $options, "", "no");
    }

    public function initOptions($options) {
        $opt = maybe_unserialize($options);
        $this->enableOnlineChecking = isset($opt["enableOnlineChecking"]) && ($v = absint($opt["enableOnlineChecking"])) ? $v : 0;
        $this->checkFrequency = isset($opt["checkFrequency"]) && ($v = absint($opt["checkFrequency"])) ? $v : 60;
        $this->checkFrequencyType = isset($opt["checkFrequencyType"]) && ($v = trim($opt["checkFrequencyType"])) ? $v : "s";
        $this->keepOnlineTime = ($this->checkFrequencyType == "s") ? $this->checkFrequency * 2 : $this->checkFrequency * 60 * 2;
        $this->isShowNotificationPopup = isset($opt["isShowNotificationPopup"]) && ($v = absint($opt["isShowNotificationPopup"])) ? $v : 0;
        $this->notificationPopupTimeout = isset($opt["notificationPopupTimeout"]) && ($v = absint($opt["notificationPopupTimeout"])) >= 1 ? $v : 10;
        $this->notificationPopupPosition = isset($opt["notificationPopupPosition"]) && ($v = trim($opt["notificationPopupPosition"])) ? $v : "bottom-right";
        $this->notificationItemBG = isset($opt["notificationItemBG"]) && ($v = trim($opt["notificationItemBG"])) ? $v : "#eee";
        $this->notificationItemTextColor = isset($opt["notificationItemTextColor"]) && ($v = trim($opt["notificationItemTextColor"])) ? $v : "#333";
        $this->onlineStatusColor = isset($opt["onlineStatusColor"]) && ($v = trim($opt["onlineStatusColor"])) ? $v : "#00b38f";
        $this->offlineStatusColor = isset($opt["offlineStatusColor"]) && ($v = trim($opt["offlineStatusColor"])) ? $v : "#ca3c3c";
        $this->showStatusLabel = isset($opt["showStatusLabel"]) && ($v = absint($opt["showStatusLabel"])) ? $v : 0;
        $this->phraseUserIsOnline = isset($opt["phraseUserIsOnline"]) && ($v = trim($opt["phraseUserIsOnline"])) ? $v : __("is online", "wpdiscuz-ou");
        $this->phraseUserLastComment = isset($opt["phraseUserLastComment"]) && ($v = trim($opt["phraseUserLastComment"])) ? $v : __("Last Comment", "wpdiscuz-ou");
        $this->phraseReadMore = isset($opt["phraseReadMore"]) && ($v = trim($opt["phraseReadMore"])) ? $v : __("read this comment &raquo;", "wpdiscuz-ou");
        $this->phraseOnline = isset($opt["phraseOnline"]) ? trim($opt["phraseOnline"]) : "";
        $this->phraseOffline = isset($opt["phraseOffline"]) ? trim($opt["phraseOffline"]) : "";
        $this->currentBlogId = get_current_blog_id();
    }

    public function saveOptions() {
        if ($this->tabKey === $_POST["wpd_tab"]) {
            $this->enableOnlineChecking = isset($_POST[$this->tabKey]["enableOnlineChecking"]) && ($v = absint($_POST[$this->tabKey]["enableOnlineChecking"])) ? $v : 0;
            $this->checkFrequency = isset($_POST[$this->tabKey]["checkFrequency"]) && ($v = absint($_POST[$this->tabKey]["checkFrequency"])) ? $v : 60;
            $this->checkFrequencyType = isset($_POST[$this->tabKey]["checkFrequencyType"]) && ($v = trim($_POST[$this->tabKey]["checkFrequencyType"])) && absint($_POST[$this->tabKey]["checkFrequency"]) ? $v : "s";
            $this->isShowNotificationPopup = isset($_POST[$this->tabKey]["isShowNotificationPopup"]) && ($v = absint($_POST[$this->tabKey]["isShowNotificationPopup"])) ? $v : 0;
            $this->notificationPopupTimeout = isset($_POST[$this->tabKey]["notificationPopupTimeout"]) && ($v = absint($_POST[$this->tabKey]["notificationPopupTimeout"])) ? $v : 10;
            $this->notificationPopupPosition = isset($_POST[$this->tabKey]["notificationPopupPosition"]) && ($v = trim($_POST[$this->tabKey]["notificationPopupPosition"])) ? $v : "bottom-right";
            $this->notificationItemBG = isset($_POST[$this->tabKey]["notificationItemBG"]) && ($v = trim($_POST[$this->tabKey]["notificationItemBG"])) ? $v : "#eee";
            $this->notificationItemTextColor = isset($_POST[$this->tabKey]["notificationItemTextColor"]) && ($v = trim($_POST[$this->tabKey]["notificationItemTextColor"])) ? $v : "#333";
            $this->onlineStatusColor = isset($_POST[$this->tabKey]["onlineStatusColor"]) && ($v = trim($_POST[$this->tabKey]["onlineStatusColor"])) ? $v : "#00b38f";
            $this->offlineStatusColor = isset($_POST[$this->tabKey]["offlineStatusColor"]) && ($v = trim($_POST[$this->tabKey]["offlineStatusColor"])) ? $v : "#ca3c3c";
            $this->showStatusLabel = isset($_POST[$this->tabKey]["showStatusLabel"]) && ($v = absint($_POST[$this->tabKey]["showStatusLabel"])) ? $v : 0;
            $this->phraseUserIsOnline = isset($_POST[$this->tabKey]["phraseUserIsOnline"]) && ($v = trim($_POST[$this->tabKey]["phraseUserIsOnline"])) ? $v : __("is online", "wpdiscuz-ou");
            $this->phraseUserLastComment = isset($_POST[$this->tabKey]["phraseUserLastComment"]) && ($v = trim($_POST[$this->tabKey]["phraseUserLastComment"])) ? $v : __("Last Comment", "wpdiscuz-ou");
            $this->phraseReadMore = isset($_POST[$this->tabKey]["phraseReadMore"]) && ($v = trim($_POST[$this->tabKey]["phraseReadMore"])) ? $v : __("read this comment &raquo;", "wpdiscuz-ou");
            $this->phraseOnline = isset($_POST[$this->tabKey]["phraseOnline"]) ? trim($_POST[$this->tabKey]["phraseOnline"]) : "";
            $this->phraseOffline = isset($_POST[$this->tabKey]["phraseOffline"]) ? trim($_POST[$this->tabKey]["phraseOffline"]) : "";
            update_option(self::OPTION_MAIN, $this->toArray());
        }
    }

    public function toArray() {
        $options = [
            "enableOnlineChecking" => $this->enableOnlineChecking,
            "checkFrequency" => $this->checkFrequency,
            "checkFrequencyType" => $this->checkFrequencyType,
            "isShowNotificationPopup" => $this->isShowNotificationPopup,
            "notificationPopupTimeout" => $this->notificationPopupTimeout,
            "notificationPopupPosition" => $this->notificationPopupPosition,
            "notificationItemBG" => $this->notificationItemBG,
            "notificationItemTextColor" => $this->notificationItemTextColor,
            "onlineStatusColor" => $this->onlineStatusColor,
            "offlineStatusColor" => $this->offlineStatusColor,
            "showStatusLabel" => $this->showStatusLabel,
            "phraseUserIsOnline" => $this->phraseUserIsOnline,
            "phraseUserLastComment" => $this->phraseUserLastComment,
            "phraseReadMore" => $this->phraseReadMore,
            "phraseOnline" => $this->phraseOnline,
            "phraseOffline" => $this->phraseOffline,
        ];
        return $options;
    }

    public function dynamicCss() {
        $styles = "#wpdcom .wc-comment .wou-status-online{color:{$this->onlineStatusColor};border: 1px solid {$this->onlineStatusColor};}";
        $styles .= "#wpdcom .wou-status-offline i{color:{$this->offlineStatusColor};}";
        $styles .= "#wpdcom .wou-status-offline{color:{$this->offlineStatusColor};border: 1px solid {$this->offlineStatusColor};}";
	    $styles .= "#wpdcom .wou-status-online i{color:{$this->onlineStatusColor};}";
	    $styles .= "#wpdcom .wou-status-online{color:{$this->onlineStatusColor};border: 1px solid {$this->onlineStatusColor};}";
	    if ($this->notificationPopupPosition == "top-left") {
            $styles .= "#wou-notification-popup{top:50px;left:50px;}";
        } else if ($this->notificationPopupPosition == "top-right") {
            $styles .= "#wou-notification-popup{top:50px;right:50px;}";
        } else if ($this->notificationPopupPosition == "bottom-left") {
            $styles .= "#wou-notification-popup{bottom:50px;left:50px;}";
        } else {
            $styles .= "#wou-notification-popup{bottom:50px;right:50px;}";
        }
        $styles .= "#wou-notification-popup .wou-notification-item{background:{$this->notificationItemBG};color:{$this->notificationItemTextColor};}";
        return $styles;
    }

    public function adminDynamicCss() {
        $styles = ".wou-status-online{color:{$this->onlineStatusColor};border: 1px solid {$this->onlineStatusColor};}";
        $styles .= ".wou-status-offline{color:{$this->offlineStatusColor};border: 1px solid {$this->offlineStatusColor};}";
        if ($this->notificationPopupPosition == "top-left") {
            $styles .= "#wou-notification-popup{top:50px;left:50px;}";
        } else if ($this->notificationPopupPosition == "top-right") {
            $styles .= "#wou-notification-popup{top:50px;right:50px;}";
        } else if ($this->notificationPopupPosition == "bottom-left") {
            $styles .= "#wou-notification-popup{bottom:50px;left:50px;}";
        } else {
            $styles .= "#wou-notification-popup{bottom:50px;right:50px;}";
        }
        $styles .= "#wou-notification-popup .wou-notification-item{background:{$this->notificationItemBG};color:{$this->notificationItemTextColor};}";
        return $styles;
    }

    public function resetOptions($tab) {
        if ($tab === $this->tabKey || $tab === "all") {
            delete_option(self::OPTION_MAIN);
            $this->addOptions();
            $this->initOptions(get_option(self::OPTION_MAIN));
        }
    }

    public function settingsArray($settings) {
        $settings["addons"][$this->tabKey] = [
            "title" => __("Online Users", "wpdiscuz-ou"),
            "title_original" => "Online Users",
            "icon" => "",
            "icon-height" => "",
            "file_path" => WOU_DIR_PATH . "/options/wou-options-html.php",
            "values" => $this,
            "options" => [
                "enableOnlineChecking" => [
                    "label" => __("Enable online status checking", "wpdiscuz-ou"),
                    "label_original" => "Enable online status checking",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "checkFrequency" => [
                    "label" => __("Online status checking rate", "wpdiscuz-ou"),
                    "label_original" => "Online status checking rate",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "isShowNotificationPopup" => [
                    "label" => __("Enable pop-up notification of new online users", "wpdiscuz-ou"),
                    "label_original" => "Enable pop-up notification of new online users",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "notificationPopupTimeout" => [
                    "label" => __("Hide pop-up notification in", "wpdiscuz-ou"),
                    "label_original" => "Hide pop-up notification in",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "notificationPopupPosition" => [
                    "label" => __("Pop-up notification location", "wpdiscuz-ou"),
                    "label_original" => "Pop-up notification location",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "notificationItemBG" => [
                    "label" => __("Pop-up notification background color", "wpdiscuz-ou"),
                    "label_original" => "Pop-up notification background color",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "notificationItemTextColor" => [
                    "label" => __("Pop-up notification text color", "wpdiscuz-ou"),
                    "label_original" => "Pop-up notification text color",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "onlineStatusColor" => [
                    "label" => __("Online status color", "wpdiscuz-ou"),
                    "label_original" => "Online status color",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "offlineStatusColor" => [
                    "label" => __("Offline status color", "wpdiscuz-ou"),
                    "label_original" => "Offline status color",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "showStatusLabel" => [
                    "label" => __("Show Status Label", "wpdiscuz-ou"),
                    "label_original" => "Show Status Label",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "phraseUserIsOnline" => [
                    "label" => __('"X" user is online', "wpdiscuz-ou"),
                    "label_original" => '"X" user is online',
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "phraseUserLastComment" => [
                    "label" => __('"X" user last comment', "wpdiscuz-ou"),
                    "label_original" => '"X" user last comment',
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "phraseReadMore" => [
                    "label" => __('"read this comment" link text', "wpdiscuz-ou"),
                    "label_original" => '"read this comment" link text',
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "phraseOnline" => [
                    "label" => __("Online status label", "wpdiscuz-ou"),
                    "label_original" => "Online status label",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "phraseOffline" => [
                    "label" => __("Offline status label", "wpdiscuz-ou"),
                    "label_original" => "Offline status label",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
            ],
        ];
        return $settings;
    }

}

<?php

/*
 * Plugin Name: wpDiscuz - Online Users
 * Description: Adds online/offline indicator next to the comment author names.
 * Version: 7.0.0
 * Author: gVectors Team
 * Author URI: https://www.gvectors.com/
 * Plugin URI: https://www.gvectors.com/wpdiscuz/
 * Text Domain: wpdiscuz-ou
 * Domain Path: /languages/
 */
if (!defined("ABSPATH")) {
    exit();
}

define("WOU_DIR_PATH", dirname(__FILE__));
define("WOU_DIR_NAME", basename(WOU_DIR_PATH));

include_once WOU_DIR_PATH . "/includes/gvt-api-manager.php";
include_once WOU_DIR_PATH . "/includes/wou-constans.php";
include_once WOU_DIR_PATH . "/includes/wou-db-managaer.php";
include_once WOU_DIR_PATH . "/includes/wou-helper.php";
include_once WOU_DIR_PATH . "/includes/wou-helper-ajax.php";
include_once WOU_DIR_PATH . "/options/wou-options.php";

class WpdiscuzOnlineUsers implements WOUConstants {

    private $dbManager;
    private $options;
    private $helper;
    private $helperAjax;
    private $version;
    private $checkFrequency;
    public static $IS_USER_LOGGED_IN = false;
    public static $CURRENT_USER = null;

    public function __construct() {
        $this->version = get_option(self::OPTION_VERSION, "1.0.0");
        $this->dbManager = new WOUDBManager();
        register_activation_hook(__FILE__, [$this->dbManager, "createTables"]);
        add_action("admin_notices", [$this, "requirements"], 1);
        add_action("plugins_loaded", [$this, "dependencies"], 1);
    }

    public function requirements() {
        if (!function_exists("wpDiscuz") && current_user_can("manage_options")) {
            echo "<div class='error'><p>" . __("wpDiscuz Online Users requires wpDiscuz to be installed!", "wpdiscuz-ou") . "</p></div>";
        }
    }

    public function dependencies() {
        if (function_exists("wpDiscuz")) {
            if (is_user_logged_in()) {
                self::$IS_USER_LOGGED_IN = true;
                self::$CURRENT_USER = wp_get_current_user();
            }
            new GVT_API_Manager(__FILE__, "wpdiscuz_options_page", "wpdiscuz_option_page");
            $this->options = new WOUOptions();
            $this->helper = new WOUHelper($this->dbManager, $this->options);
            $this->helperAjax = new WOUHelperAjax($this->dbManager, $this->options, $this->helper);
            $this->checkFrequency = $this->options->checkFrequencyType == "s" ? $this->options->checkFrequency * 1000 : $this->options->checkFrequency * 60 * 1000;
            load_plugin_textdomain("wpdiscuz-ou", false, WOU_DIR_NAME . "/languages/");
            add_action("wpdiscuz_check_version", [&$this, "newVersion"]);
            add_action("admin_enqueue_scripts", [&$this, "backendFiles"]);
            add_action("wp_enqueue_scripts", [&$this, "frontendFiles"]);
        }
    }

    public function newVersion() {
        $pluginData = get_plugin_data(__FILE__);
        $newVersion = $pluginData["Version"];
        if (version_compare($newVersion, $this->version, ">")) {
            $options = get_option(self::OPTION_MAIN);
            $this->addNewOptions($options);
            update_option(self::OPTION_VERSION, $newVersion);
            $this->version = $newVersion;

            if ($newVersion == "1.0.5") {
                $this->dbManager->updateUserEmails();
            } else if ($newVersion == "1.0.6") {
                $this->dbManager->removeAll();
            }
        }
    }

    /**
     * merge old and new options
     */
    private function addNewOptions($options) {
        $this->options->initOptions($options);
        $newOptions = $this->options->toArray();
        update_option(self::OPTION_MAIN, $newOptions);
    }

    public function backendFiles() {
        $wpdiscuz = wpDiscuz();
        $suf = $wpdiscuz->options->general["loadMinVersion"] ? ".min" : "";
        if (is_rtl()) {
            $handle = "wou-rtl-css";
            wp_register_style($handle, plugins_url(WOU_DIR_NAME . "/assets/css/wou-rtl$suf.css"), null, $this->version);
            wp_enqueue_style($handle);
        } else {
            $handle = "wou-css";
            wp_register_style($handle, plugins_url(WOU_DIR_NAME . "/assets/css/wou$suf.css"), null, $this->version);
            wp_enqueue_style($handle);
        }
        wp_add_inline_style($handle, $this->options->adminDynamicCss());
        if ($this->options->enableOnlineChecking) {
            $cookieData = $this->helper->getDataFromCookie();
            $currentUserEmail = $cookieData["user_email"];
            $currentUserName = $cookieData["display_name"];
            if (self::$CURRENT_USER) {
                $currentUserEmail = self::$CURRENT_USER->user_email;
                $currentUserName = self::$CURRENT_USER->display_name ? self::$CURRENT_USER->display_name : self::$CURRENT_USER->user_login;
            }

            $vars = [
                "wouAjaxUrl" => admin_url("admin-ajax.php"),
                "wouCurrentOnlineUsers" => $this->helper->getOnlineUsersUIDS(),
                "wouCurrentUserEmail" => urldecode($currentUserEmail),
                "wouCurrentUserName" => urldecode($currentUserName),
                "wouCookieHash" => COOKIEHASH,
                "wouCheckFrequency" => $this->checkFrequency,
                "wouPhraseStatusOnline" => __($this->options->phraseOnline, "wpdiscuz-ou"),
                "wouPhraseStatusOffline" => __($this->options->phraseOffline, "wpdiscuz-ou"),
                "wouIsShowNotificationPopup" => $this->options->isShowNotificationPopup,
                "wouNotificationPopupTimeout" => $this->options->notificationPopupTimeout,
            ];

            wp_register_script("wou-js", plugins_url(WOU_DIR_NAME . "/assets/js/wou$suf.js"), ["jquery"], $this->version, false);
            wp_enqueue_script("wou-js");
            wp_localize_script("wou-js", "wouVars", $vars);
        }
    }

    public function frontendFiles() {
        $wpdiscuz = wpDiscuz();
        $suf = $wpdiscuz->options->general["loadMinVersion"] ? ".min" : "";
        if (is_rtl()) {
            $handle = "wou-rtl-css";
            wp_register_style($handle, plugins_url(WOU_DIR_NAME . "/assets/css/wou-rtl$suf.css"), null, $this->version);
            wp_enqueue_style($handle);
        } else {
            $handle = "wou-css";
            wp_register_style($handle, plugins_url(WOU_DIR_NAME . "/assets/css/wou$suf.css"), null, $this->version);
            wp_enqueue_style($handle);
        }
        wp_add_inline_style($handle, $this->options->dynamicCss());
        if ($this->options->enableOnlineChecking) {
            $cookieData = $this->helper->getDataFromCookie();
            $currentUserEmail = $cookieData["user_email"];
            $currentUserName = $cookieData["display_name"];
            if (self::$CURRENT_USER) {
                $currentUserEmail = self::$CURRENT_USER->user_email;
                $currentUserName = self::$CURRENT_USER->display_name ? self::$CURRENT_USER->display_name : self::$CURRENT_USER->user_login;
            }

            $vars = [
                "wouAjaxUrl" => admin_url("admin-ajax.php"),
                "wouCurrentOnlineUsers" => $this->helper->getOnlineUsersUIDS(),
                "wouCurrentUserEmail" => urldecode($currentUserEmail),
                "wouCurrentUserName" => urldecode($currentUserName),
                "wouCookieHash" => COOKIEHASH,
                "wouCheckFrequency" => $this->checkFrequency,
                "wouPhraseStatusOnline" => __($this->options->phraseOnline, "wpdiscuz-ou"),
                "wouPhraseStatusOffline" => __($this->options->phraseOffline, "wpdiscuz-ou"),
                "wouIsShowNotificationPopup" => $this->options->isShowNotificationPopup,
                "wouNotificationPopupTimeout" => $this->options->notificationPopupTimeout,
            ];

            wp_register_script("wou-js", plugins_url(WOU_DIR_NAME . "/assets/js/wou$suf.js"), ["jquery"], $this->version, true);
            wp_enqueue_script("wou-js");
            wp_localize_script("wou-js", "wouVars", $vars);
        }
    }

}

$wpdiscuzOU = new WpdiscuzOnlineUsers();

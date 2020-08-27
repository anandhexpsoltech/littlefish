<?php

if (!defined("ABSPATH")) {
    exit();
}

include_once WV_DIR_PATH . "/manager/class.WVDBManager.php";

class WVSettings {

    public $dbmanager;
    public $settingsOptionName = "wv_settings";
    public $phrasesOptionName = "wv_phrases";
    public $wvOptions;
    public $wvPhrases;
    public $tabKey = "wv";

    public function __construct() {
        $this->dbmanager = new WVDBManager();
        add_action("wpdiscuz_save_options", [&$this, "wvSaveOptions"], 11);
        add_action("wpdiscuz_dynamic_css", [&$this, "stylingVoters"], 11);
        add_action("admin_enqueue_scripts", [&$this, "settingScripts"], 11);
        add_action("wpdiscuz_reset_options", [&$this, "resetOptions"], 11);
        add_filter("wpdiscuz_settings", [&$this, "settingsArray"], 11);
        $this->addOptionsAndPhrases();
        $this->initOptions(get_option($this->settingsOptionName));
        $this->initPhrases(get_option($this->phrasesOptionName));
    }

    public function settingScripts() {
        if (isset($_GET["page"]) && isset($_GET["wpd_tab"]) && $_GET["page"] === WpdiscuzCore::PAGE_SETTINGS && $_GET["wpd_tab"] === $this->tabKey) {
            wp_register_script("pluginScript", plugins_url(WV_DIR_NAME . "/assets/js/wv-settings.js"), ["jquery"], "1.0.0", false);
            wp_enqueue_script("pluginScript");
            wp_register_style("wvsettingsstyle", plugins_url(WV_DIR_NAME . "/assets/css/wv-settings.css"));
            wp_enqueue_style("wvsettingsstyle");
            wp_enqueue_style("wv-iconpicker-css", plugins_url(WV_DIR_NAME . "/assets/third-party/iconpicker/fontawesome-iconpicker.min.css"));
            wp_register_script("wv-iconpicker-js", plugins_url(WV_DIR_NAME . "/assets/third-party/iconpicker/fontawesome-iconpicker.js"), ["jquery"]);
            wp_enqueue_script("wv-iconpicker-js");
        }
    }

    public function resetOptions($tab) {
        if ($tab === $this->tabKey || $tab === "all") {
            $this->wvOptions = $this->defaultOptions();
            $this->wvPhrases = $this->defaultPhrases();
            update_option($this->settingsOptionName, $this->wvOptions);
            update_option($this->phrasesOptionName, $this->wvPhrases);
        }
    }

    public function addOptionsAndPhrases() {
        add_option($this->settingsOptionName, $this->defaultOptions(), "", "no");
        add_option($this->phrasesOptionName, $this->defaultPhrases(), "", "no");
    }

    public function defaultOptions() {
        $options = [
            "wv_get_avatars" => 1,
            "wv_read_more" => 1,
            "wv_read_more_get_avatar" => 1,
            "wv_real_time" => 1,
            "wv_background_color" => "#FAFAFA",
            "wv_border_color" => "#AAAAAA",
            "wv_count" => 8,
            "wv_count_all" => 8,
            "wv_level" => [
                1 => [
                    "vote" => ["value" => 1],
                    "icon" => [
                        "value" => "fas fa-user",
                        "enable" => 1,
                        "color" => "#0CD85D"
                    ],
                    "label" => [
                        "value" => __("Member", "wpdiscuz_likers"),
                        "enable" => 1
                    ],
                ],
                2 => [
                    "vote" => ["value" => 10],
                    "icon" => [
                        "value" => "fas fa-star",
                        "enable" => 1,
                        "color" => "#E5D600"
                    ],
                    "label" => [
                        "value" => __("Active Member", "wpdiscuz_likers"),
                        "enable" => 1
                    ],
                ],
                3 => [
                    "vote" => ["value" => 50],
                    "icon" => [
                        "value" => "fas fa-certificate",
                        "enable" => 1,
                        "color" => "#FF812D"
                    ],
                    "label" => [
                        "value" => __("Trusted Member", "wpdiscuz_likers"),
                        "enable" => 1,
                    ],
                ],
                4 => [
                    "vote" => ["value" => 100],
                    "icon" => [
                        "value" => "fas fa-shield-alt",
                        "enable" => 1,
                        "color" => "#43A6DF"
                    ],
                    "label" => [
                        "value" => __("Noble Member", "wpdiscuz_likers"),
                        "enable" => 1
                    ],
                ],
                5 => [
                    "vote" => ["value" => 500],
                    "icon" => [
                        "value" => "fas fa-trophy",
                        "enable" => 1,
                        "color" => "#E04A47"
                    ],
                    "label" => [
                        "value" => __("Famed Member", "wpdiscuz_likers"),
                        "enable" => 1
                    ],
                ]]
        ];
        return $options;
    }

    public function defaultPhrases() {
        $phrases = [
            "wv_guests" => __("Guests", "wpdiscuz_likers"),
            "wv_view_all" => __("View all", "wpdiscuz_likers"),
        ];
        return $phrases;
    }

    public function initOptions($options) {
        $default = $this->defaultOptions();
        foreach ($default as $key => $value) {
            $this->wvOptions[$key] = isset($options[$key]) ? $options[$key] : $value;
        }
    }

    public function saveOptions() {
        if ($this->tabKey === $_POST["wpd_tab"]) {
            if ($_POST[$this->tabKey]["wv_level"][1]["vote"]["value"] != 0 &&
                    $_POST[$this->tabKey]["wv_level"][1]["vote"]["value"] < $_POST[$this->tabKey]["wv_level"][2]["vote"]["value"] &&
                    $_POST[$this->tabKey]["wv_level"][2]["vote"]["value"] < $_POST[$this->tabKey]["wv_level"][3]["vote"]["value"] &&
                    $_POST[$this->tabKey]["wv_level"][3]["vote"]["value"] < $_POST[$this->tabKey]["wv_level"][4]["vote"]["value"] &&
                    $_POST[$this->tabKey]["wv_level"][4]["vote"]["value"] < $_POST[$this->tabKey]["wv_level"][5]["vote"]["value"]) {
                
            } else {
                $_POST[$this->tabKey]["wv_level"][1]["vote"]["value"] = 1;
                $_POST[$this->tabKey]["wv_level"][2]["vote"]["value"] = 10;
                $_POST[$this->tabKey]["wv_level"][3]["vote"]["value"] = 50;
                $_POST[$this->tabKey]["wv_level"][4]["vote"]["value"] = 100;
                $_POST[$this->tabKey]["wv_level"][5]["vote"]["value"] = 500;
            }
            for ($i = 1; $i < 6; $i++) {
                $_POST[$this->tabKey]["wv_level"][$i]["label"]["enable"] = isset($_POST[$this->tabKey]["wv_level"][$i]["label"]["enable"]) ? absint($_POST[$this->tabKey]["wv_level"][$i]["label"]["enable"]) : 0;
                $_POST[$this->tabKey]["wv_level"][$i]["icon"]["enable"] = isset($_POST[$this->tabKey]["wv_level"][$i]["icon"]["enable"]) ? absint($_POST[$this->tabKey]["wv_level"][$i]["icon"]["enable"]) : 0;
            }
            $this->wvOptions["wv_get_avatars"] = isset($_POST[$this->tabKey]["wv_get_avatars"]) ? absint($_POST[$this->tabKey]["wv_get_avatars"]) : 0;
            $this->wvOptions["wv_real_time"] = isset($_POST[$this->tabKey]["wv_real_time"]) ? absint($_POST[$this->tabKey]["wv_real_time"]) : 0;
            $this->wvOptions["wv_read_more"] = isset($_POST[$this->tabKey]["wv_read_more"]) ? absint($_POST[$this->tabKey]["wv_read_more"]) : 0;
            $this->wvOptions["wv_read_more_get_avatar"] = isset($_POST[$this->tabKey]["wv_read_more_get_avatar"]) ? absint($_POST[$this->tabKey]["wv_read_more_get_avatar"]) : 0;
            $this->wvOptions["wv_count"] = isset($_POST[$this->tabKey]["wv_count"]) ? absint($_POST[$this->tabKey]["wv_count"]) : 8;
            $this->wvOptions["wv_count_all"] = isset($_POST[$this->tabKey]["wv_count_all"]) ? absint($_POST[$this->tabKey]["wv_count_all"]) : 8;
            $this->wvOptions["wv_level"] = $_POST[$this->tabKey]["wv_level"];
            $this->wvOptions["wv_background_color"] = isset($_POST[$this->tabKey]["wv_background_color"]) ? $_POST[$this->tabKey]["wv_background_color"] : "#FAFAFA";
            $this->wvOptions["wv_border_color"] = isset($_POST[$this->tabKey]["wv_border_color"]) ? $_POST[$this->tabKey]["wv_border_color"] : "#AAAAAA";
            update_option($this->settingsOptionName, $this->wvOptions);
        }
    }

    public function initPhrases($phrases) {
        $default = $this->defaultPhrases();
        foreach ($default as $key => $value) {
            $this->wvPhrases[$key] = isset($phrases[$key]) ? wp_unslash($phrases[$key]) : wp_unslash($value);
        }
    }

    public function savePhrases() {
        if ($this->tabKey === $_POST["wpd_tab"]) {
            $default = $this->defaultPhrases();
            $this->wvPhrases["wv_guests"] = isset($_POST[$this->tabKey]["wv_guests"]) ? wp_unslash($_POST[$this->tabKey]["wv_guests"]) : wp_unslash($default["wv_guests"]);
            $this->wvPhrases["wv_view_all"] = isset($_POST[$this->tabKey]["wv_view_all"]) ? wp_unslash($_POST[$this->tabKey]["wv_view_all"]) : wp_unslash($default["wv_view_all"]);
            update_option($this->phrasesOptionName, $this->wvPhrases);
        }
    }

    public function wvSaveOptions() {
        $this->saveOptions();
        $this->savePhrases();
    }

    public function stylingVoters($options) {
        $css = "#wpcomm .vote-head, .vote-head-right,.wv-vote-content{background-color:" . $this->wvOptions["wv_background_color"] . ";border-color:" . $this->wvOptions["wv_border_color"] . "!important; color: #666666; font-size:13px;}";
        $css .= "#wpcomm .wv-head .vote-arrow,#wpcomm .wv-head-right .vote-arrow{border-bottom:10px solid " . $this->wvOptions["wv_border_color"] . ";}";
        $css .= "#wpcomm .wv-head .vote-arrow-no-border,#wpcomm .wv-head-right .vote-arrow-no-border{border-bottom-color:" . $this->wvOptions["wv_background_color"] . ";}";
        $css .= ".vote-head a:hover,.wv-vote-content a:hover,.wv-view-all-button:hover{color:" . $options->thread_styles["primaryColor"] . " !important}";
        echo $css;
    }

    public function settingsArray($settings) {
        $settings["addons"][$this->tabKey] = [
            "title" => __("Advanced Likers", "wpdiscuz_likers"),
            "title_original" => "Advanced Likers",
            "icon" => "",
            "icon-height" => "",
            "file_path" => WV_DIR_PATH . "/settings/settings.php",
            "values" => $this,
            "options" => [
                "wv_get_avatars" => [
                    "label" => __("Display avatars on quick list of likers pop-up", "wpdiscuz_likers"),
                    "label_original" => "Display avatars on quick list of likers pop-up",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "wv_real_time" => [
                    "label" => __("Real time", "wpdiscuz_likers"),
                    "label_original" => "Real time",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "wv_read_more" => [
                    "label" => __("View all", "wpdiscuz_likers"),
                    "label_original" => "View all",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "wv_read_more_get_avatar" => [
                    "label" => __("Display avatars on full likers list", "wpdiscuz_likers"),
                    "label_original" => "Display avatars on full likers list",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "wv_count" => [
                    "label" => __("Max number of likers on quick pop-up window", "wpdiscuz_likers"),
                    "label_original" => "Max number of likers on quick pop-up window",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "wv_count_all" => [
                    "label" => __("Max number of likers on pop-up window", "wpdiscuz_likers"),
                    "label_original" => "Max number of likers on pop-up window",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "wv_level" => [
                    "label" => __("Comment Author Rating and Badge", "wpdiscuz_likers"),
                    "label_original" => "Comment Author Rating and Badge",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "wv_background_color" => [
                    "label" => __("Likers quick pop-up background color", "wpdiscuz_likers"),
                    "label_original" => "Likers quick pop-up background color",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "wv_border_color" => [
                    "label" => __("Likers quick pop-up border color", "wpdiscuz_likers"),
                    "label_original" => "Likers quick pop-up border color",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "wv_guests" => [
                    "label" => __("Guests", "wpdiscuz_likers"),
                    "label_original" => "Guests",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "wv_view_all" => [
                    "label" => __("View all", "wpdiscuz_likers"),
                    "label_original" => "View all",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ],
                "recountVotes" => [
                    "label" => __("Recount user votes", "wpdiscuz_likers"),
                    "label_original" => "Recount user votes",
                    "description" => "",
                    "description_original" => "",
                    "docurl" => "#"
                ]
            ],
        ];
        return $settings;
    }

}

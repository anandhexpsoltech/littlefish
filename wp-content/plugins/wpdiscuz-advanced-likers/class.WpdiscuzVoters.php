<?php

if (!defined("ABSPATH")) {
    exit();
}
/*
 * Plugin Name: wpDiscuz - Advanced Liking
 * Description: See comment likers and voters of each comment. Adds user reputation and badges based on received likes.
 * Version: 7.0.1
 * Author: gVectors Team
 * Author URI: https://gvectors.com/
 * Plugin URI: https://gvectors.com/product/wpdiscuz-advanced-liking/
 * Text Domain: wpdiscuz_likers
 * Domain Path: /languages/
 */

define("WV_DIR_PATH", dirname(__FILE__));
define("WV_DIR_NAME", basename(WV_DIR_PATH));
include_once WV_DIR_PATH . "/manager/class.WVDBManager.php";
include_once WV_DIR_PATH . "/settings/class.WVSettings.php";
include_once WV_DIR_PATH . "/includes/gvt-api-manager.php";

class WpdiscuzVoters {

    public $comment_id;
    public $dbmanager;
    public $settings;
    private $version;
    private $versionName = "wv_plugin_version";
    public $voteTypeUpIcon;
    public $voteTypeDownIcon;

    public function __construct() {
        add_action("plugins_loaded", [& $this, "pluginsLoaded"], 11);
    }

    public function pluginsLoaded() {
        if (function_exists("wpDiscuz")) {
            $this->version = get_option($this->versionName, "1.0.0");
            new GVT_API_Manager(__FILE__, "wpdiscuz_options_page", "wpdiscuz_option_page");
            $this->settings = new WVSettings();
            $this->dbmanager = new WVDBManager();
            load_plugin_textdomain("wpdiscuz_likers", false, WV_DIR_NAME . "/languages/");
            add_action("wp_ajax_nopriv_viewAll", [&$this, "viewAllAjax"], 11);
            add_action("wp_ajax_nopriv_voters", [&$this, "votersAjax"], 11);
            add_action("wpdiscuz_check_version", [&$this, "pluginNewVersion"], 11);
            add_action("wpdiscuz_front_scripts", [&$this, "registerScripts"], 11);
            add_action("wp_ajax_viewAll", [&$this, "viewAllAjax"], 11);
            add_action("wp_ajax_voters", [&$this, "votersAjax"], 11);
            add_action("wp_footer", [&$this, "concatDiv"], 11);
            add_action("wpdiscuz_after_label", [&$this, "label"], 11, 2);
            add_action("wpdiscuz_update_vote", [&$this, "updateRating"], 11, 3);
            add_action("wpdiscuz_add_vote", [&$this, "addRating"], 11, 2);
            add_action("wpdiscuz_js_options", [&$this, "wvJsOptions"], 11, 2);
            add_action("wp_ajax_wvRecountVotes", [&$this, "recountVotes"], 11);
        } else {
            add_action("admin_notices", [&$this, "wvRequirements"], 1);
        }
    }

    public function wvRequirements() {
        if (current_user_can("manage_options")) {
            echo "<div class='error'><p>" . __("wpDiscuz Advanced Liking requires wpDiscuz to be installed!", "wpdiscuz_likers") . "</p></div>";
        }
    }

    public function wvJsOptions($jsOptions, $wpdiscuzOptions) {
        $jsOptions["wvRealTime"] = $this->settings->wvOptions["wv_real_time"];
        return $jsOptions;
    }

    public function updateRating($voteType, $isUserVoted, $comment) {
        $this->addRating($voteType, $comment);
    }

    public function addRating($voteType, $comment) {
        if ($comment->user_id) {
            $rating = get_user_meta($comment->user_id, "wv_rating", true);
            update_user_meta($comment->user_id, "wv_rating", $rating + $voteType);
        }
    }

    public function label($afterLabelHtml, $comment) {
        if (0 == $comment->user_id) {
            return $afterLabelHtml;
        }
        $user_rating = intval(get_user_meta($comment->user_id, "wv_rating", true));
        $level = $this->settings->wvOptions["wv_level"];
        if ($user_rating < $level[1]["vote"]["value"]) {
            return $afterLabelHtml;
        }
        $icon = "";
        $title = "";
        for ($i = count($level); $i > 0; $i--) {
            if ($user_rating >= intval($level[$i]["vote"]["value"])) {
                if ($level[$i]["icon"]["enable"]) {
                    $icon = "<i class='" . $level[$i]["icon"]["value"] . "' style='color:" . $level[$i]["icon"]["color"] . "'></i>";
                }
                if ($level[$i]["label"]["enable"]) {
                    $title = $level[$i]["label"]["value"];
                }
                break;
            }
        }
        $afterLabelHtml .= $title || $icon ? "<div class='wv_level_box'><div class='wv-badge'>" . $icon . "</div><div class='wv-title'>" . $title . "</div></div>" : "";
        return $afterLabelHtml;
    }

    public function pluginNewVersion() {
        $pluginData = get_plugin_data(__FILE__);
        if (version_compare($pluginData["Version"], $this->version, ">")) {
            if (version_compare($this->version, "1.0.0", "!=") && version_compare($this->version, "1.2.2", "<=")) {
                $this->changeOldOptions();
            }
            update_option($this->versionName, $pluginData["Version"]);
        } else {
            update_option($this->versionName, $this->version);
        }
    }

    public function changeOldOptions() {
        $options = get_option($this->settings->settingsOptionName);
        $options["wv_get_avatars"] = (int) ($options["wv_get_avatars"] === "yes");
        $options["wv_real_time"] = (int) ($options["wv_real_time"] === "yes");
        $options["wv_read_more"] = (int) ($options["wv_read_more"] === "yes");
        $options["wv_read_more_get_avatar"] = (int) ($options["wv_read_more_get_avatar"] === "yes");
        update_option($this->settings->settingsOptionName, $options);
    }

    public function registerScripts($options) {
        $suf = $options->general["loadMinVersion"] ? ".min" : "";
        wp_register_style("wpdiscuz-voters-style", plugins_url(WV_DIR_NAME . "/assets/css/wv$suf.css"), null, $this->version);
        wp_enqueue_style("wpdiscuz-voters-style");
        if (is_rtl()) {
            if ($options->thread_layouts["votingButtonsStyle"]) {
                wp_register_style("wpdiscuz-voters-style-rtl", plugins_url(WV_DIR_NAME . "/assets/css/wv-rtl-seperate$suf.css"), null, $this->version);
                wp_enqueue_style("wpdiscuz-voters-style-rtl");
            } else {
                wp_register_style("wpdiscuz-voters-style-rtl", plugins_url(WV_DIR_NAME . "/assets/css/wv-rtl$suf.css"), null, $this->version);
                wp_enqueue_style("wpdiscuz-voters-style-rtl");
            }
        }
        wp_register_script("wpdiscuz-voters-script", plugins_url("assets/js/wv$suf.js", __FILE__), ["jquery"], $this->version, true);
        wp_enqueue_script("wpdiscuz-voters-script");
    }

    public function votersAjax() {
        $html = "";
        if (isset($_POST["id"]) && ($id_comment = intval($_POST["id"])) && !empty($_POST["hovered"]) && ($typeVote = trim($_POST["hovered"]))) {
            $wpdiscuz = wpDiscuz();
            $voteIconType = $wpdiscuz->options->thread_layouts["votingButtonsIcon"] ? explode("|", $wpdiscuz->options->thread_layouts["votingButtonsIcon"]) : ["fa-plus", "fa-minus"];
            $count = $this->settings->wvOptions["wv_count"];
            $users_id = $this->dbmanager->getVotes($id_comment, $typeVote, $count);
            $getAvatar = $this->settings->wvOptions["wv_get_avatars"];
            $count_plus = 0;
            $count_minus = 0;
            foreach ($users_id as $userInfo) {
                $id = intval($userInfo["user_id"]);
                $user = get_userdata($id);
                if ($user) {
                    $username = $wpdiscuz->helper->getCurrentUserDisplayName($user);
                    $userPageLinkHTML = "<a href='" . esc_url(get_author_posts_url($id)) . "'><span class='wv-username'>" . esc_html($username) . "</span></a>";
                    $avatar = $getAvatar == 1 ? get_avatar($id) : "";
                    if ($userInfo["vote_type"] == 1) {
                        $html .= "<div class='wv-user-info'>" . $avatar . "<span class='wv-plus'><i class='fas " . $voteIconType[0] . " wv-up-color'></i></span> " . $userPageLinkHTML . "</div>";
                    } else {
                        $html .= "<div class='wv-user-info'>" . $avatar . "<span class='wv-minus'><i class='fas " . $voteIconType[1] . " wv-down-color'></i></span> " . $userPageLinkHTML . "</div>";
                    }
                } else {
                    if ($userInfo["vote_type"] == 1) {
                        $count_plus++;
                    } else {
                        $count_minus++;
                    }
                }
            }
            if ($typeVote == "like") {
                $count_plus += $this->dbmanager->getGuestVotesCount($id_comment, 1);
            } elseif ($typeVote == "dislike") {
                $count_minus += $this->dbmanager->getGuestVotesCount($id_comment, -1);
            } else {
                $count_plus += $this->dbmanager->getGuestVotesCount($id_comment, 1);
                $count_minus += $this->dbmanager->getGuestVotesCount($id_comment, -1);
            }
            $phraseGuests = esc_html__($this->settings->wvPhrases["wv_guests"], "wpdiscuz_likers");
            $guest_avatar = $getAvatar == 1 ? get_avatar(0) : "";
            if ($count_plus) {
                $html .= "<div class='wv-user-info'>" . $guest_avatar . "<span class='wv-plus'>" . esc_html($count_plus) . " <i class='fas " . $voteIconType[0] . " wv-up-color'></i></span> " . $phraseGuests . "</div>";
            }
            if ($count_minus) {
                $html .= "<div class='wv-user-info'>" . $guest_avatar . "<span class='wv-minus'>" . esc_html($count_minus) . " <i class='fas " . $voteIconType[1] . " wv-down-color'></i></span> " . $phraseGuests . "</div>";
            }
            if ($html) {
                if (1 == $this->settings->wvOptions["wv_read_more"]) {
                    $html .= "<span class='wv-view-all-button-" . $typeVote . " wv-view-all-button'>" . esc_html__($this->settings->wvPhrases["wv_view_all"], "wpdiscuz_likers") . "</span>";
                }
                $output = "<div class='wv-body' data-type='" . $typeVote . "'>";
                $output .= "<div class='wv-head vote-head'>";
                $output .= "<span class='wv-arrow vote-arrow'></span><span class='wv-arrow-no-border vote-arrow-no-border'></span>";
                $output .= "<div class='wv-vote-content'>";
                $output .= $html;
                $output .= "</div>";
                $output .= "</div>";
                $output .= "</div>";
                $html = $output;
            }
        }
        wp_die($html);
    }

    public function viewAllAjax() {
        $html = "";
        if (isset($_POST["id"]) && ($id = intval($_POST["id"])) && !empty($_POST["hovered"]) && ($hoverType = trim($_POST["hovered"]))) {
            $page = !empty($_POST["page"]) ? intval($_POST["page"]) : 1;
            $limit = $this->settings->wvOptions["wv_count_all"];
            $offset = ($page - 1) * $limit;
            $count = $this->dbmanager->getVotesCount($id, $hoverType);
            $loadMore = "";
            $getAvatar = $this->settings->wvOptions["wv_read_more_get_avatar"];
            $na = $getAvatar == 0 ? " wv-no-avatar" : "";
            $wpdiscuz = wpDiscuz();
            $voteIconType = $wpdiscuz->options->thread_layouts["votingButtonsIcon"] ? explode("|", $wpdiscuz->options->thread_layouts["votingButtonsIcon"]) : ["fa-plus", "fa-minus"];
            $count_plus = 0;
            $count_minus = 0;
            if ($offset < $count) {
                $users_ids = $this->dbmanager->getVotes($id, $hoverType, $limit, $offset);
                foreach ($users_ids as $userInfo) {
                    $user_id = intval($userInfo["user_id"]);
                    $userData = get_userdata($user_id);
                    if ($userData) {
                        $username = $wpdiscuz->helper->getCurrentUserDisplayName($userData);
                        $userPageLinkHTML = "<a href='" . esc_url(get_author_posts_url($user_id)) . "'><span class='wv-username'>" . esc_html($username) . "</span></a>";
                        $avatar = $getAvatar == 1 ? get_avatar($user_id, 64) : "";
                        if ($userInfo["vote_type"] == 1) {
                            $html .= "<div class='wv-user-info-all" . $na . "'>" . $avatar . "<span class='wv-plus'><i class='fas " . $voteIconType[0] . " wv-up-color'></i></span> " . $userPageLinkHTML . "</div>";
                        } else {
                            $html .= "<div class='wv-user-info-all" . $na . "'>" . $avatar . "<span class='wv-minus'><i class='fas " . $voteIconType[1] . " wv-down-color'></i></span> " . $userPageLinkHTML . "</div>";
                        }
                    } else {
                        if ($userInfo["vote_type"] == 1) {
                            $count_plus++;
                        } else {
                            $count_minus++;
                        }
                    }
                }
                if ($offset + count($users_ids) < $count) {
                    $loadMore .= "<input class='wv_hidden_page' type='hidden' name='wv_page' value='" . ($page + 1) . "' />";
                    $loadMore .= "<input class='wv_hidde_type' type='hidden' name='wv_type' value='$hoverType' />";
                    $loadMore .= "<input class='wv_hidden_id' type='hidden' name='wv_id' value='$id' />";
                    $loadMore .= "<span class='wv-read_more'>" . esc_html__($this->settings->wvPhrases["wv_view_all"], "wpdiscuz_likers") . "</span>";
                }
            }
            if ($page == 1) {
                if ($hoverType == "like") {
                    $count_plus += $this->dbmanager->getGuestVotesCount($id, 1);
                } elseif ($hoverType == "dislike") {
                    $count_minus += $this->dbmanager->getGuestVotesCount($id, -1);
                } else {
                    $count_plus += $this->dbmanager->getGuestVotesCount($id, 1);
                    $count_minus += $this->dbmanager->getGuestVotesCount($id, -1);
                }
                $phraseGuests = esc_html__($this->settings->wvPhrases["wv_guests"], "wpdiscuz_likers");
                $guest_avatar = $getAvatar == 1 ? get_avatar(0, 64) : "";
                if ($count_plus) {
                    $html .= "<div class='wv-user-info-all" . $na . "'>" . $guest_avatar . "<span class='wv-plus'><i class='fas " . $voteIconType[0] . " wv-up-color'></i> " . esc_html($count_plus) . "</span> " . $phraseGuests . "</div>";
                }
                if ($count_minus) {
                    $html .= "<div class='wv-user-info-all" . $na . "'>" . $guest_avatar . "<span class='wv-minus'><i class='fas " . $voteIconType[1] . " wv-down-color'></i> " . esc_html($count_minus) . "</span> " . $phraseGuests . "</div>";
                }
            }
            $html .= $loadMore;
        }
        wp_die($html);
    }

    public function concatDiv() {
        global $post;
        $wpdiscuz = wpDiscuz();
        if ($wpdiscuz->helper->isLoadWpdiscuz($post)) {
            echo "<div class='wv-view-all'></div><div class='wv-all-html'></div>";
        }
    }

    public function recountVotes() {
        $response = ["progress" => 0];
        $step = !empty($_POST["recount-user-votes-step"]) ? intval($_POST["recount-user-votes-step"]) : 0;
        $count = !empty($_POST["recount-user-votes-count"]) ? intval($_POST["recount-user-votes-count"]) : 0;
        $startId = !empty($_POST["recount-user-votes-start-id"]) ? intval($_POST["recount-user-votes-start-id"]) : 0;
        $nonce = !empty($_POST["wv_recount_nonce"]) ? trim($_POST["wv_recount_nonce"]) : "";
        if ($count && $nonce && wp_verify_nonce($nonce, "wv_recount")) {
            if ($count && $startId >= 0) {
                $getData = $this->dbmanager->getUsersCountWithComments($startId);
                if ($getData) {
                    $this->dbmanager->recountVotes($getData[0]);
                    ++$step;
                    $progress = $step * 100 / $count;
                    $response["progress"] = ($p = intval($progress)) > 100 ? 100 : $p;
                    $response["startId"] = $getData[0];
                } else {
                    $response["progress"] = 100;
                    $response["startId"] = 0;
                }
                $response["step"] = $step;
            }
        }
        wp_die(json_encode($response));
    }

}

$wpDiscuzVoters = new WpdiscuzVoters();
?>
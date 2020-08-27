<?php

if (!defined("ABSPATH")) {
    exit();
}

class WOUHelper implements WOUConstants {

    private $dbManager;
    private $options;
    public $onlineUsers;

    public function __construct($dbManager, $options) {
        $this->dbManager = $dbManager;
        $this->options = $options;
        add_action("wp_loaded", [&$this, "addCurrentOnlineUser"]);
        add_filter("wpdiscuz_after_comment_author", [&$this, "statusAfterAuthorName"], 10, 3);
        add_action("transition_comment_status", [&$this, "commentStatusOnlineUsers"], 50, 3);
        add_action("comment_post", [&$this, "commentPostOnlineUsers"], 50, 3);
    }

    public function addCurrentOnlineUser() {
        $userData = $this->getUserData();
        if ($this->isValidUserdata($userData)) {
            $this->dbManager->addOnlineUser($userData);
        }
        $this->onlineUsers = $this->dbManager->getOnlineUsers($this->options->currentBlogId, $this->options->keepOnlineTime);        
    }

    private function getDefaultData() {
        $wpdiscuz = wpDiscuz();
        return [
            "blog_id" => $this->options->currentBlogId,
            "user_ip" => $wpdiscuz->helper->getRealIPAddr(),
            "user_id" => 0,
            "user_email" => "",
            "display_name" => "",
        ];
    }

    public function getUserData($email = "", $displayName = "") {
        $wpdiscuz = wpDiscuz();
        $user = WpdiscuzOnlineUsers::$CURRENT_USER;
        $defaults = $this->getDefaultData();
        $args = [
            "user_id" => $user && $user->ID ? $user->ID : 0,
            "user_email" => $email,
            "display_name" => $displayName,
        ];

        if ($wpdiscuz->options->login["isUserByEmail"] && $args["user_email"]) {
            $user = get_user_by("email", $args["user_email"]);
            if ($user && $user->ID) {
                $args["user_id"] = $user->ID;
                $args["user_email"] = $user->user_email;
                $args["display_name"] = $user->display_name ? $user->display_name : $user->user_login;
            }
        }


        if (!$args["user_email"] || !$args["display_name"]) {
            if ($user && $user->ID) {
                $args["user_email"] = $args["user_email"] ? $args["user_email"] : $user->user_email;
                if (!$args["display_name"]) {
                    $args["display_name"] = $user->display_name ? $user->display_name : $user->user_login;
                }
            } else {
                $cookieData = $this->getDataFromCookie();
                if (!$args["user_email"]) {
                    $args["user_email"] = $cookieData["user_email"];
                }
                if (!$args["display_name"]) {
                    $args["display_name"] = $cookieData["display_name"];
                }
            }
        }
        $userData = wp_parse_args($args, $defaults);
        $userData["user_email"] = urldecode($userData["user_email"]);
        $userData["display_name"] = urldecode($userData["display_name"]);
        return $userData;
    }

    public function isUserOnline($email) {
        $isOnline = false;
        if ($this->onlineUsers && is_array($this->onlineUsers)) {
            $isOnline = array_key_exists($email, $this->onlineUsers);
        }
        return $isOnline;
    }

    public function statusAfterAuthorName($afterCommentAuthorName, $comment, $user) {
        $email = $user ? $user->user_email : $comment->comment_author_email;
        $userUniqueId = $this->getUniqueId($email);
        if ($this->isUserOnline($userUniqueId)) {
            $statusPhrase = __($this->options->phraseOnline, "wpdiscuz-ou");
            $statusClass = "wou-status-online";
            $title = $statusPhrase ? $statusPhrase : __("Online", "wpdiscuz-ou");
        } else {
            $statusPhrase = __($this->options->phraseOffline, "wpdiscuz-ou");
            $statusClass = "wou-status-offline";
	        $title = $statusPhrase ? $statusPhrase : __("Offline", "wpdiscuz-ou");
        }

        $phraseContainer = "<span class='wou-status-phrase'>$statusPhrase</span>";
        if (!$this->options->showStatusLabel) {
            $phraseContainer = "";
            $statusClass .= " wou-status-only-icon"; 
        }


        $status = "<div class='wou-status $statusClass' wpd-tooltip='$title'>";
        $status .= "<i class='fas fa-circle' aria-hidden='true'></i>";
        $status .= $phraseContainer;
        $status .= "<input type='hidden' class='wou-uuid' value='$userUniqueId'/>";
        $status .= "</div>";
        $afterCommentAuthorName .= $status;
        return $afterCommentAuthorName;
    }

    public function getOnlineUsersUIDS($users = []) {
        $uuIds = [];
        $onlineUsers = $users ? $users : $this->onlineUsers;
        if ($onlineUsers && is_array($onlineUsers)) {
            foreach ($onlineUsers as $emailKey => $nameValue) {
                $uuIds[] = $emailKey;
            }
        }
        return $uuIds;
    }

    public function getUniqueId($email) {
        return str_rot13($email);
    }

    public function isValidUserdata($userData) {
        return $userData && is_array($userData) && $userData["user_email"] && $userData["display_name"];
    }

    public function commentPostOnlineUsers($commentId, $commentApproved, $commentdata) {
        if ($commentApproved == 1 && $commentdata["comment_author_email"] && $commentdata["comment_author"]) {
            $userData = $this->getUserData($commentdata["comment_author_email"], $commentdata["comment_author"]);
            if ($this->isValidUserdata($userData)) {
                $email = $this->getUniqueId($commentdata["comment_author_email"]);
                $name = $commentdata["comment_author"];
                $this->dbManager->addOnlineUser($userData);
                if (!array_key_exists($email, $this->onlineUsers)) {
                    $this->onlineUsers[$email] = $name;
                }
            }
        }
    }

    public function commentStatusOnlineUsers($newStatus, $oldStatus, $comment) {
        if ($newStatus != $oldStatus) {
            $userData = $this->getUserData($comment->comment_author_email, $comment->comment_author);
            if ($newStatus == "approved" && $this->isValidUserdata($userData)) {
                $email = $this->getUniqueId($comment->comment_author_email);
                $name = $comment->comment_author;
                $this->dbManager->addOnlineUser($userData);
                if (!array_key_exists($email, $this->onlineUsers)) {
                    $this->onlineUsers[$email] = $name;
                }
            }
        }
    }

    public function getDataFromCookie() {
        $data = [
            "user_email" => isset($_COOKIE["comment_author_email_" . COOKIEHASH]) && $_COOKIE["comment_author_email_" . COOKIEHASH] ? $_COOKIE["comment_author_email_" . COOKIEHASH] : "",
            "display_name" => isset($_COOKIE["comment_author_" . COOKIEHASH]) && $_COOKIE["comment_author_" . COOKIEHASH] ? $_COOKIE["comment_author_" . COOKIEHASH] : "",
        ];
        return $data;
    }

}

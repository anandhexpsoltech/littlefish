<?php

if (!defined("ABSPATH")) {
    exit();
}

class WOUHelperAjax implements WOUConstants {

    private $dbManager;
    private $options;
    private $helper;

    public function __construct($dbManager, $options, $helper) {
        $this->dbManager = $dbManager;
        $this->options = $options;
        $this->helper = $helper;

        if ($this->options->enableOnlineChecking) {
            add_action("wp_ajax_wouCheckOnlineUsers", [&$this, "checkOnlineUsers"]);
            add_action("wp_ajax_nopriv_wouCheckOnlineUsers", [&$this, "checkOnlineUsers"]);
        }

        if ($this->options->isShowNotificationPopup) {
            add_action("wp_footer", [&$this, "addNotificationPopup"]);
            add_action("admin_footer", [&$this, "addNotificationPopup"]);
            add_action("wp_ajax_wouPushNotification", [&$this, "pushNotification"]);
            add_action("wp_ajax_nopriv_wouPushNotification", [&$this, "pushNotification"]);
        }
    }

    public function checkOnlineUsers() {
        $response = ["onlineUsers" => [], "pushItems" => []];
        $postData = filter_input(INPUT_POST, "wouAjaxData");
        if ($postData) {
            $data = json_decode($postData, true);
            $email = isset($data["email"]) && ($value = trim($data["email"])) ? $value : "";
            $name = isset($data["name"]) && ($value = trim($data["name"])) ? $value : "";
            $currentUuids = isset($data["onlineUsers"]) && ($value = $data["onlineUsers"]) ? $value : [];
            $userData = $this->helper->getUserData($email, $name);
            if ($this->helper->isValidUserdata($userData)) {
                $this->dbManager->addOnlineUser($userData);
            }
        }

        $this->helper->onlineUsers = $this->dbManager->getOnlineUsers($this->options->currentBlogId, $this->options->keepOnlineTime);
        foreach ($this->helper->onlineUsers as $uuid => $nameValue) {
            $response["onlineUsers"][] = $uuid;
            if (is_array($currentUuids) && !in_array($uuid, $currentUuids)) {
                $response["pushItems"][] = ["email" => $uuid, "name" => $nameValue];
            }
        }
        wp_die(json_encode($response));
    }

    public function pushNotification() {
        $response = ["data" => ""];
        $postData = filter_input(INPUT_POST, "wouAjaxData");
        if ($postData) {
            $data = json_decode($postData, true);
            $users = isset($data["users"]) && is_array($data["users"]) && ($value = $data["users"]) ? $value : "";
            if ($users) {
                $items = [];
                foreach ($users as $user) {
                    $name = isset($user["name"]) ? trim($user["name"]) : "";
                    $email = isset($user["email"]) ? $this->helper->getUniqueId(trim($user["email"])) : "";
                    if ($email) {
                        $userInfo = ["email" => $email, "name" => $name, "comment" => ""];
                        $userComments = get_comments(["author_email" => $email, "status" => "approve", "number" => 1]);
                        if ($userComments && is_array($userComments)) {
                            $userInfo["name"] = $userComments[0]->comment_author;
                            $userInfo["comment"] = $userComments[0];
                        }
                        if ($userInfo["name"]) {
                            ob_start();
                            include WOU_DIR_PATH . "/includes/wou-notification-item.php";
                            $items[] = ob_get_clean();
                        }
                    }
                }
                $response["data"] = $items;
            }
        }
        wp_die(json_encode($response));
    }

    public function addNotificationPopup() {
        include WOU_DIR_PATH . "/includes/wou-notification-container.php";
    }

}

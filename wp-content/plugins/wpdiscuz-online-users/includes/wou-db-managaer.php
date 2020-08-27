<?php

if (!defined("ABSPATH")) {
    exit();
}

class WOUDBManager implements WOUConstants {

    private $db;
    private $tblOnlineUsers;

    public function __construct() {
        global $wpdb;
        $this->db = $wpdb;
        $this->tblOnlineUsers = $wpdb->prefix . "wc_online_users";

        add_action("wpmu_new_blog", [&$this, "onNewBlog"], 10, 6);
        add_filter("wpmu_drop_tables", [&$this, "onDeleteBlog"]);
    }

    /**
     * creates table for censored words
     */
    public function createTables($networkWide) {
        global $wpdb;
        if (is_multisite() && $networkWide) {
            $blogIds = $this->db->get_col("SELECT `blog_id` FROM {$wpdb->blogs}");
            foreach ($blogIds as $blogId) {
                switch_to_blog($blogId);
                $this->createTable();
                restore_current_blog();
            }
        } else {
            $this->createTable();
        }
    }

    public function createTable() {
        require_once ABSPATH . "wp-admin/includes/upgrade.php";
        $sql = "CREATE TABLE {$this->tblOnlineUsers}(`id` INT (10) NOT NULL AUTO_INCREMENT, `blog_id` INT (10) NOT NULL DEFAULT 0, `user_id` INT (10) NOT NULL DEFAULT 0, `user_email` VARCHAR (100) NOT NULL, `display_name` VARCHAR (255) NOT NULL, `user_ip` VARCHAR (32) NOT NULL, `last_online` TIMESTAMP DEFAULT CURRENT_TIMESTAMP, `last_online_timestamp` INT(10) DEFAULT 0, PRIMARY KEY (`id`), KEY `blog_id` (`blog_id`), KEY `user_id` (`user_id`), KEY `user_ip` (`user_ip`), KEY `last_online_timestamp` (`last_online_timestamp`), UNIQUE KEY `unique_online_user` (`blog_id`, `user_id`, `user_email`)) DEFAULT CHARACTER SET {$this->db->charset} COLLATE {$this->db->collate};";
        maybe_create_table($this->tblOnlineUsers, $sql);
    }

    public function onNewBlog($blogId, $userId, $domain, $path, $siteId, $meta) {
        if (is_plugin_active_for_network(WOU_DIR_NAME . "/wpdiscuz-ou.php")) {
            switch_to_blog($blogId);
            $this->createTable();
            restore_current_blog();
        }
    }

    public function onDeleteBlog($tables) {
        $tables[] = $this->tblOnlineUsers;
        return $tables;
    }

    /* =============== ONLINE USERS FUNCTIONS =============== */

    private function isOnlineUserExists($blogId, $userId, $userEmail) {
        if ($uId = intval($userId)) {
            $sql = "SELECT `id` FROM {$this->tblOnlineUsers} WHERE `blog_id` = %d AND `user_id` = %d LIMIT 1;";
            $sql = $this->db->prepare($sql, $blogId, $uId);
        } else {
            $sql = "SELECT `id` FROM {$this->tblOnlineUsers} WHERE `blog_id` = %d AND `user_id` = %d AND `user_email` = %s LIMIT 1;";
            $sql = $this->db->prepare($sql, $blogId, $uId, $userEmail);
        }
        return $this->db->get_var($sql);
    }

    public function addOnlineUser($userData) {
        $blogId = intval($userData["blog_id"]);
        $userId = intval($userData["user_id"]);
        $userEmail = str_rot13(trim($userData["user_email"]));
        $displayName = trim($userData["display_name"]);
        $userIp = md5(trim($userData["user_ip"]));
        $lastOnline = current_time("mysql");
        $lastOnlineTimestamp = strtotime($lastOnline);
        if ($id = $this->isOnlineUserExists($blogId, $userId, $userEmail)) {
            $sql = "UPDATE {$this->tblOnlineUsers} SET `user_email` = %s, `display_name` = %s, `user_ip` = %s, `last_online` = %s, `last_online_timestamp` = %d WHERE `blog_id` = %d AND `id` = %d;";
            $sql = $this->db->prepare($sql, $userEmail, $displayName, $userIp, $lastOnline, $lastOnlineTimestamp, $blogId, $id);
        } else {
            $sql = "INSERT INTO {$this->tblOnlineUsers} (`blog_id`, `user_id`, `user_email`, `display_name`, `user_ip`, `last_online`, `last_online_timestamp`) VALUES (%d, %d, %s, %s, %s, %s, %d)";
            $sql = $this->db->prepare($sql, $blogId, $userId, $userEmail, $displayName, $userIp, $lastOnline, $lastOnlineTimestamp);
        }
        return $this->db->query($sql);
    }

    public function getOnlineUsers($blogId, $keepOnlineTime, $limit = 0) {
        $unixNow = current_time("timestamp");
        if ($limit) {
            $sql = "SELECT `user_email`, `display_name` FROM {$this->tblOnlineUsers} WHERE `blog_id` = %d AND `last_online_timestamp` + %d >= %d LIMIT %d;";
            $sql = $this->db->prepare($sql, $blogId, $keepOnlineTime, $unixNow, $limit);
        } else {
            $sql = "SELECT `user_email`, `display_name` FROM {$this->tblOnlineUsers} WHERE `blog_id` = %d AND `last_online_timestamp` + %d >= %d;";
            $sql = $this->db->prepare($sql, $blogId, $keepOnlineTime, $unixNow);
        }
        $data = [];
        $result = $this->db->get_results($sql, ARRAY_A);
        if ($result && is_array($result)) {
            foreach ($result as $r) {
                $key = urldecode($r["user_email"]);
                $value = urldecode($r["display_name"]);
                $data[$key] = $value;
            }
        }
        return $data;
    }

    public function updateUserEmails() {
        $data = $this->db->get_results("SELECT `id`, `user_email` FROM `$this->tblOnlineUsers`;", ARRAY_A);
        foreach ($data as $d) {
            $this->db->update($this->tblOnlineUsers, ["user_email" => base64_encode($d["user_email"])], ["id" => $d["id"]]);
        }
    }

    public function removeAll() {
        $this->db->query("TRUNCATE `$this->tblOnlineUsers`;");
    }

}

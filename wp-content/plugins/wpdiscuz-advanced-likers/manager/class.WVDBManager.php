<?php

if (!defined("ABSPATH")) {
    exit();
}

class WVDBManager {

    public $dbm;

    public function __construct() {
        global $wpdb;
        $this->dbm = $wpdb;
        $this->voted = $this->dbm->prefix . "wc_users_voted";
    }

    public function getVotes($id, $type, $limit, $offset = 0) {
        $voteQuery = "`vote_type` != 0";
        if ($type == "like") {
            $voteQuery = "`vote_type` = 1";
        } else if ($type == "dislike") {
            $voteQuery = "`vote_type` = -1";
        }
        $sql = $this->dbm->prepare("SELECT `user_id`, `vote_type` FROM `" . $this->voted . "` WHERE `is_guest` = 0 AND `comment_id` = %d AND " . $voteQuery . " ORDER BY `id` DESC LIMIT %d OFFSET %d", $id, $limit, $offset);
        return $this->dbm->get_results($sql, ARRAY_A);
    }

    public function getVotesCount($id, $voteType) {
        $voteQuery = "`vote_type` != 0";
        if ($voteType == "like") {
            $voteQuery = "`vote_type` = 1";
        } else if ($voteType == "dislike") {
            $voteQuery = "`vote_type` = -1";
        }
        $sql = $this->dbm->prepare("SELECT COUNT(`id`) AS `count` FROM `" . $this->voted . "` WHERE `is_guest` = 0 AND `comment_id` = %d AND " . $voteQuery . " ORDER BY `id` DESC", $id);
        return $this->dbm->get_var($sql);
    }

    public function getCurentUserVote($userId, $commentId, $type) {
        $sql = $this->dbm->prepare("SELECT `vote_type` FROM `" . $this->voted . "` WHERE `user_id` = %d AND `comment_id` = %d AND `vote_type` = %d", $userId, $commentId, $type);
        return $this->dbm->get_var($sql);
    }

    public function getGuestVotesCount($id, $vote_type) {
        $sql = $this->dbm->prepare("SELECT COUNT(`id`) AS `count` FROM `" . $this->voted . "` WHERE `is_guest` = 1 AND `comment_id` = %d AND `vote_type` = %d", $id, $vote_type);
        return $this->dbm->get_var($sql);
    }

    public function getUsersCountWithComments($startId) {
        $sql = $this->dbm->prepare("SELECT DISTINCT `user_id` FROM `{$this->dbm->comments}` WHERE `user_id` != 0 AND `user_id` > %d ORDER BY `user_id` ASC", $startId);
        return $this->dbm->get_col($sql);
    }

    public function recountVotes($id) {
        $sql = $this->dbm->prepare("SELECT SUM(`cm`.`meta_value`) FROM `{$this->dbm->commentmeta}` AS `cm` INNER JOIN `{$this->dbm->comments}` AS `c` ON `c`.`comment_ID` = `cm`.`comment_id` AND `c`.`user_id` = %d WHERE `cm`.`meta_key` = 'wpdiscuz_votes'", $id);
        $count = intval($this->dbm->get_var($sql));
        update_user_meta($id, "wv_rating", $count);
    }

}

?>
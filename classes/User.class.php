<?php
class User {
	private $email;
	private $id;
	private $topicId;
	private $loggedIn = false;

	public function __construct($email = false) {
		if (empty($email)) {
			return;
		}
		$this->loggedIn = true;
		$email = $GLOBALS['conn']->real_escape_string($email);
		$query = $GLOBALS['conn']->query("
			SELECT user_id, last_topic_id
			FROM users
			WHERE user_email LIKE '$email'");
		if ($query->num_rows > 0) {
			$row = $query->fetch_object();
			$this->email = $email;
			$this->id = $row->user_id;
			$this->topicId = $row->last_topic_id;
		} else {
			$GLOBALS['conn']->query("
				INSERT INTO users
				(user_email) VALUES ('$email')");
			$this->email = $email;
			$this->id = $GLOBALS['conn']->insert_id;
			$GLOBALS['conn']->query("
				INSERT INTO topics
				(user_id, topic_name, topic_coords)
				VALUES
				($this->id, 'First Topic', '0,0')");
			$this->topicId = $GLOBALS['conn']->insert_id;
			$GLOBALS['conn']->query("
				UPDATE users
				SET last_topic_id=$this->topicId
				WHERE user_id=$this->id");
		}
	}

	public function getUserId() {
		return $this->id;
	}

	public function isLoggedIn() {
		return $this->loggedIn;
	}

	public function setTopic($topicId) {
		$GLOBALS['conn']->query("
			UPDATE users
			SET last_topic_id=$topicId
			WHERE user_id=$this->id");
		$this->topicId = $topicId;
	}

	public function getViewedTopicId() {
		return $this->topicId;
	}

	public function getTopics() {
		$topics = array();
		$query = $GLOBALS['conn']->query("
			SELECT topic_id, topic_name
			FROM topics
			WHERE user_id=$this->id
			ORDER BY topic_name");
		while ($row = $query->fetch_object()) {
			$topics[$row->topic_id] = $row->topic_name;
		}
		return $topics;
	}
}
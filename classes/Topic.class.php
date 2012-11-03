<?php
class Topic {
	private $id;
	private $name;
	private $coords;

	public function __construct($topicId, $user) {
		$query = $GLOBALS['conn']->query("
			SELECT topic_id, topic_name, topic_coords
			FROM topics
			WHERE user_id=".$user->getUserId()." AND topic_id=$topicId");
		$row = $query->fetch_object();
		$this->id = $row->topic_id;
		$this->name = $row->topic_name;
		$this->coords = $row->topic_coords;
	}

	public function getId() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
	}

	public static function create($topicName, $user) {
		$topicName = $GLOBALS['conn']->real_escape_string($topicName);
		$GLOBALS['conn']->query("
			INSERT INTO topics
			(user_id, topic_name, topic_coords)
			VALUES
			(".$user->getUserId().", '$topicName', '0,0')");
		$topicId = $GLOBALS['conn']->insert_id;
		$GLOBALS['conn']->query("
			UPDATE users
			SET last_topic_id=$topicId
			WHERE user_id=".$user->getUserId());		
	}

	public static function update($topicName, $topicId, $user) {
		$topicName = $GLOBALS['conn']->real_escape_string($topicName);
		$topicId = $GLOBALS['conn']->real_escape_string($topicId);
		$GLOBALS['conn']->query("
			UPDATE INTO topics
			SET topic_name='$topicName'
			WHERE topic_id=$topicId AND user_id=".$user->getUserId());
	}

	public static function delete($topicId, $user) {
		$topicId = $GLOBALS['conn']->real_escape_string($topicId);
		//Make sure there is at least 1 other topic for this user
		$query = $GLOBALS['conn']->query("
			SELECT topic_id
			FROM topics
			WHERE user_id=".$user->getUserId()." AND topic_id!=$topicId");
		if ($query->num_rows > 0) {
			$row = $query->fetch_object();
			$newTopicId = $row->topic_id;
			$GLOBALS['conn']->query("
				UPDATE users
				SET last_topic_id=$newTopicId
				WHERE user_id=".$user->getUserId());		
			$GLOBALS['conn']->query("
				DELETE FROM topics
				WHERE topic_id=$topicId");
			return true;
		} else {
			return false;
		}
	}
}
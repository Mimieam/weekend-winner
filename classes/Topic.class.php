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

	public function getTasks() {
		$tasks = array();
		$s3 = new AmazonS3();
		$query = $GLOBALS['conn']->query("
			SELECT *
			FROM tasks
			WHERE topic_id=".$this->id);
		while ($row = $query->fetch_assoc()) {
			$tasks[$row['task_id']] = array(
				'id' => $row['task_id'],
				'content' => $row['task_content'],
				'color' => $row['task_color'],
			);
			if ($row['task_eventtime'] > 0) {
				$tasks[$row['task_id']]['eventDate'] = date('m/d/Y', $row['task_eventtime']);
			}

			$top = $left = 0;
			if (strpos($row['task_coord'], ',')) {
				list($top, $left) = explode(',', $row['task_coord']);
			}
			$tasks[$row['task_id']]['top'] = round($top);
			$tasks[$row['task_id']]['left'] = round($left);
			$tasks[$row['task_id']]['attachments'] = array();
			$tasks[$row['task_id']]['assocs'] = array();
		}
		if (count($tasks)) {
			$query = $GLOBALS['conn']->query("
				SELECT task_id_1, task_id_2
				FROM task_assocs
				WHERE task_id_2 IN (".implode(',', array_keys($tasks)).")");
			while ($row = $query->fetch_object()) {
				$tasks[$row->task_id_2]['assocs'][] = $row->task_id_1;
			}

			$query = $GLOBALS['conn']->query("
				SELECT task_id, attachment_path, attachment_id
				FROM task_attachments
				WHERE task_id IN (".implode(',', array_keys($tasks)).")");
			while ($row = $query->fetch_object()) {
				$tasks[$row->task_id]['attachments'][$row->attachment_id] = array(
					'id'   => $row->attachment_id,
					'name' => substr($row->attachment_path, strlen($row->task_id) + 1),
					'url'  => $s3->get_object_url(S3_BUCKET, $row->attachment_path),
				);
				$type = strtolower(substr($row->attachment_path, -3));
				if (in_array($type, array('png', 'gif', 'jpg'))) {
					$tasks[$row->task_id]['attachments'][$row->attachment_id]['isImage'] = true;
				} else {
					$tasks[$row->task_id]['attachments'][$row->attachment_id]['isNotImage'] = true;
				}
			}
		}
		return $tasks;
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
			UPDATE topics
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

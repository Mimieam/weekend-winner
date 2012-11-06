<?php
class Task {
	public static function create($taskForm, $topic, $user) {
		/**
		 * @todo Get tags working
		 */
		$taskText = $GLOBALS['conn']->real_escape_string($taskForm['task-text']);
		$taskColor = !empty($taskForm['task-color']) ? strtolower(substr($GLOBALS['conn']->real_escape_string($taskForm['task-color']), 0, 6)) : 'd66279';
		$taskDate = !empty($taskForm['task-date']) ? strtotime($taskForm['task-date']) : 0;
		$taskReminder = !empty($taskForm['task-reminder']) ? strtotime($taskForm['task-reminder']) : 0;
		$taskCoords = !empty($taskForm['task-coords']) ? $taskForm['task-coords'] : '0,0';
		list($y, $x) = explode(',', $taskCoords);
		if (round($x) != $x || round($y) != $y) {
			$taskCoords = round($y).','.round($x);
		}

		$taskAssoc = false;
		if (!empty($taskForm['task-assoc'])) {
			$query = $GLOBALS['conn']->query("
				SELECT task_id
				FROM tasks
				WHERE task_id=".$GLOBALS['conn']->real_escape_string($taskForm['task-assoc'])."
					AND user_id=".$user->getUserId()." AND topic_id=".$topic->getId());
			if ($query->num_rows > 0) {
				$taskAssoc = $GLOBALS['conn']->real_escape_string($taskForm['task-assoc']);
			}
		}
		$GLOBALS['conn']->query("
			INSERT INTO tasks
			(user_id, task_createtime, task_content, task_coord,
			 topic_id, task_eventtime, task_alerttime, task_color)
			VALUES
			(".$user->getUserId().", ".time().", '$taskText', '$taskCoords',
			 ".$topic->getId().", $taskDate, $taskReminder, '$taskColor')");
		$taskId = $GLOBALS['conn']->insert_id;
		if (!empty($taskId)) {
			if (!empty($taskAssoc)) {
				if ($taskId < $taskAssoc) {
					$taskId1 = $taskId;
					$taskId2 = $taskAssoc;
				} else {
					$taskId2 = $taskId;
					$taskId1 = $taskAssoc;					
				}
				$GLOBALS['conn']->query("
					INSERT INTO task_assocs
					(task_id_1, task_id_2)
					VALUES
					($taskId1, $taskId2)");
			}
			if (!empty($_FILES['task-attachment']['name'])) {
				//Push the file to S3
				$s3 = new AmazonS3();
				$fileName = $taskId .'-' . $_FILES['task-attachment']['name'];
				//move the file  
				$result = $s3->create_object(
					S3_BUCKET,
					$fileName,
					array(
						'fileUpload' => $_FILES['task-attachment']['tmp_name'],
						'acl' => AmazonS3::ACL_PUBLIC,
						'contentType' => $_FILES['task-attachment']['type'],
					)
				);
				$attachmentPath = $GLOBALS['conn']->real_escape_string($fileName);
				$GLOBALS['conn']->query("
					INSERT INTO task_attachments
					(task_id, attachment_path)
					VALUES
					($taskId, '$attachmentPath')");
			}
			return true;
		} else {
			return false;
		}
	}

	public static function delete($taskId, $topic, $user) {
		/**
		 * @todo Get tags working
		 */
		$taskId = $GLOBALS['conn']->real_escape_string($taskId);
		$GLOBALS['conn']->query("
			DELETE FROM tasks
			WHERE user_id=".$user->getUserId()." AND task_id='$taskId'");
		if ($GLOBALS['conn']->affected_rows) {
			$GLOBALS['conn']->query("
				DELETE FROM task_assocs
				WHERE task_id_1='$taskId' OR task_id_2='$taskId'");
		}
		return true;
	}

	public static function reposition($id, $top, $left, $user) {
		$taskId = $GLOBALS['conn']->real_escape_string($id);
		$top = round($GLOBALS['conn']->real_escape_string($top));
		$left = round($GLOBALS['conn']->real_escape_string($left));
		$coords = !empty($top) ? $top : '0';
		$coords .= ',';
		$coords .= !empty($left) ? $left : '0';
		$GLOBALS['conn']->query("
			UPDATE tasks
			SET task_coord='$coords'
			WHERE task_id='$taskId' AND user_id=".$user->getUserId());
	}
}

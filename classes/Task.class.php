<?php
class Task {
	public static function create($taskForm, $topic, $user) {
		/**
		 * @todo Get tags working
		 */
		$taskText = $GLOBALS['conn']->real_escape_string($taskForm['task-text']);
		$taskColor = !empty($taskForm['task-color']) ? substr($GLOBALS['conn']->real_escape_string($taskForm['task-color']), 1) : 'ffffff';
		$taskDate = !empty($taskForm['task-date']) ? strtotime($taskForm['task-date']) : 0;
		$taskReminder = !empty($taskForm['task-reminder']) ? strtotime($taskForm['task-reminder']) : 0;
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
			(".$user->getUserId().", ".time().", '$taskText', '0,0',
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
			return true;
		} else {
			return false;
		}
	}

	public static function reposition($id, $top, $left, $user) {
		$taskId = $GLOBALS['conn']->real_escape_string($id);
		$coords = $GLOBALS['conn']->real_escape_string($top).',';
		$coords .= $GLOBALS['conn']->real_escape_string($left);
		$GLOBALS['conn']->query("
			UPDATE tasks
			SET task_coord='$coords'
			WHERE task_id='$taskId' AND user_id=".$user->getUserId());
	}
}
<?php
class User {
	private $email;
	private $id;
	private $loggedIn = false;

	public function __construct($email = false) {
		if (empty($email)) {
			return;
		}
		$this->loggedIn = true;
		$email = $GLOBALS['conn']->real_escape_string($email);
		$query = $GLOBALS['conn']->query("
			SELECT user_id
			FROM users
			WHERE user_email LIKE '$email'");
		if ($query->num_rows > 0) {
			$row = $query->fetch_object();
			$this->email = $email;
			$this->id = $row->user_id;
		} else {
			$GLOBALS['conn']->query("
				INSERT INTO users
				(user_email) VALUES ('$email')");
			$this->email = $email;
			$this->id = $GLOBALS['conn']->insert_id;
		}
	}

	public function isLoggedIn() {
		return $this->loggedIn;
	}
}
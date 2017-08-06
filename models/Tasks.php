<?php

/**
* Retrieve all tasks info from DB
*/
class Tasks
{
	private static $tasksOnPage = 3;

	public static function getTasks() 
	{
		if (isset($_GET['sort'])) {
			$sql = "SELECT * FROM Tasks ORDER BY ". $_GET['sort'] ." LIMIT " . self::$tasksOnPage;
		}
		else {
			$sql = "SELECT * FROM Tasks LIMIT " . self::$tasksOnPage;
		}

		return self::getTasksArrayByQuery($sql);
	}

	public static function getTasksOnPage($pageNumber) 
	{
		$offset = ($pageNumber - 1) * self::$tasksOnPage;

		if (isset($_GET['sort'])) {
			$sql = "SELECT * FROM Tasks 
					ORDER BY ". $_GET['sort'] .
					" LIMIT " . self::$tasksOnPage . 
					" OFFSET " . $offset;
		}
		else {
			$sql = "SELECT * FROM Tasks LIMIT " . self::$tasksOnPage . " OFFSET " . $offset;
		}

		return self::getTasksArrayByQuery($sql);
	}

	private static function getTasksArrayByQuery($sql)
	{
		$db = DBConnection::getConnection();

		$tasksList = array();
		
		$result = $db->query($sql);

		$i = 0;
		while($row = $result->fetch()) {
			$tasksList[$i]['id_task'] = $row['id_task'];
			$tasksList[$i]['user_name'] = $row['user_name'];
			$tasksList[$i]['user_email'] = $row['user_email'];
			$tasksList[$i]['text'] = $row['text'];
			$tasksList[$i]['img_path'] = $row['img_path'];
			$tasksList[$i]['status'] = $row['status'];
			$i++;
		}

		return $tasksList;
	}

	public static function getNumberOfPages()
	{
		$db = DBConnection::getConnection();

		$numberOfTasks = $db->query("SELECT COUNT(*) as number FROM Tasks");
		$numberOfTasks = $numberOfTasks->fetch();

		$numberOfPages = ceil( $numberOfTasks['number'] / self::$tasksOnPage );

		return $numberOfPages;
	}

	public static function addTaskToDB($post, $files)
	{
		$db = DBConnection::getConnection();

		$user_name = $db->quote($post['user_name']);
		$user_email = $db->quote($post['user_email']);
		$text = $db->quote($post['text']);

		$sql = "INSERT INTO Tasks (user_name, user_email, text) VALUES (". $user_name .", ". $user_email .", ". $text .")";

		if(isset($files) && !empty($files) && $files['task_img']['tmp_name']) {
			$uploadfile = '/uploads/' . uniqid() . ($files['task_img']['name']);

		    $max_width = 320;
			$max_height = 240;

			list($orig_width, $orig_height) = getimagesize($files['task_img']['tmp_name']);

		    $width = $orig_width;
		    $height = $orig_height;

		    # taller
		    if ($height > $max_height) {
		        $width = ($max_height / $height) * $width;
		        $height = $max_height;
		    }

		    # wider
		    if ($width > $max_width) {
		        $height = ($max_width / $width) * $height;
		        $width = $max_width;
		    }

			$thumb = imagecreatetruecolor($width, $height);

			preg_match("'^(.*)(gif|jpe?g|png)$'i", $files['task_img']['type'], $ext);
		    switch (strtolower($ext[2])) {
		        case 'jpg' : 
		        case 'jpeg': $source = imagecreatefromjpeg($files['task_img']['tmp_name']);
							 imagecopyresized($thumb, $source, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);
							 imagejpeg($thumb, $files['task_img']['tmp_name']);
		                     break;
		        case 'gif' : $source = imagecreatefromgif($files['task_img']['tmp_name']);
							 imagecopyresized($thumb, $source, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);
							 imagegif($thumb, $files['task_img']['tmp_name']);
		                     break;
		        case 'png' : $source = imagecreatefrompng($files['task_img']['tmp_name']);
							 imagecopyresized($thumb, $source, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);
							 imagepng($thumb, $files['task_img']['tmp_name']);
		                     break;
		        default    : $stop = true;
		                     break;
		    }

		    if(!isset($stop)) {
				move_uploaded_file($files['task_img']['tmp_name'], ROOT . $uploadfile);
				$sql = "INSERT INTO Tasks (user_name, user_email, text, img_path) VALUES (". $user_name .", ". $user_email .", ". $text .", '". $uploadfile ."')";
		    }
		}

		$sth = $db->prepare($sql);
		$sth->execute();
	}

		public static function markTaskAsDone($id_task)
	{
		if(!empty($_SESSION) && $_SESSION['admin']) {
			$db = DBConnection::getConnection();

			$sql = "UPDATE Tasks SET status=1 WHERE id_task=" . $id_task;
			$db->query($sql);
		}
	}

}
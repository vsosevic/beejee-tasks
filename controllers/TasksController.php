<?php
include_once ROOT . '/models/Tasks.php';

/**
* Class that works with tasks
*/
class TasksController
{
	public function actionList()
	{
		$tasksList = array();
		$tasksList = Tasks::getTasks();

		$numberOfPages = Tasks::getNumberOfPages();
		require_once(ROOT . '/views/layouts/header.php');
		require_once(ROOT . '/views/tasks/index.php');
		require_once(ROOT . '/views/layouts/footer.php');

		return true;
	}

	public function actionPage($pageNumber)
	{
		$numberOfPages = Tasks::getNumberOfPages();

		if ($pageNumber < 1 || $pageNumber > $numberOfPages) {
			die();
		}
		$tasksList = array();
		$tasksList = Tasks::getTasksOnPage($pageNumber);

		require_once(ROOT . '/views/layouts/header.php');
		require_once(ROOT . '/views/tasks/index.php');
		require_once(ROOT . '/views/layouts/footer.php');

		return true;
	}

	public function actionAdd()
	{
		if(isset($_POST) && !empty($_POST)) {
			Tasks::addTaskToDB($_POST, $_FILES);
			header("Location: /tasks/");
		}
		
		// header("Content-Type: application/javascript");
		require_once(ROOT . '/views/layouts/header.php');
		require_once(ROOT . '/views/tasks/add.php');
		require_once(ROOT . '/views/layouts/footer.php');

		return true;
	}

	public function actionDone($id_task)
	{
		if(!empty($_SESSION) && $_SESSION['admin']) {
			Tasks::markTaskAsDone($id_task);
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}

		return true;
	}

}
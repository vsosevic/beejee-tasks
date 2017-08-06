<?php
/**
* Class to verify a user. According to task user=admin, pass=123
*/
class LoginController
{
	public function actionLogin()
	{
		if(isset($_POST) && !empty($_POST)) {
			if($_POST['login'] == 'admin' && $_POST['password'] == '123') {
				$_SESSION['admin'] = 'true';
				header("Location: /tasks/");
			}
		}
		require_once(ROOT . '/views/layouts/header.php');
		require_once(ROOT . '/views/login/index.php');
		require_once(ROOT . '/views/layouts/footer.php');

		return true;
	}

	public function actionLogout()
	{
		session_destroy();
		header("Location: /tasks/");
	}

}
<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action
{

	public function index()
	{
		//session_start();

		$this->checkedAuth();


		$user = array(
			'email' => '',
			'password' => '',
		);

		$registerUser = array(
			'email' => '',
			'password' => '',
		);

		//$erroCadastro = '';


		$this->view->user = $user;
		$this->view->errorEmailExist = false;
		$this->view->errorCadastro = false;
		$this->view->errorName = false;

		$this->render('index');
	}

	public function login()
	{
		$user = Container::getModel('User');

		$user->__set('email', $_POST['email']);
		$user->__set('password', $_POST['password']);


		// $user = array(
		// 	'email' => '',
		// 	'password' => '',
		// );
		//$this->view->user = $user;

		// echo '<pre>';
		// print_r($user);
		// echo '</pre>';

		$user->auth();
		//$this->view->user = $user;


		echo '<pre>';
		print_r($user);
		echo '</pre>';


		if ($user->__get('id') != '' && $user->__get('name')) {

			session_start();

			$_SESSION['id'] = $user->__get('id');
			$_SESSION['name'] = $user->__get('name');

			header('Location: /home');
		} else {
			echo 'senha errada <br>';
			//print_r($this->render('oi'));

			$user = array(
				'email' => '',
				'password' => '',
			);
			$this->view->user = $user;

			$this->render('index');

			//header('Location:/?404=erro');
		}

		// $this->view->usuario = array(
		// 	'email' => '',
		// 	'senha' => '',
		// );

		//$this->view->erroCadastro = false;

		//$this->render('inscreverse');
	}

	public function register()
	{
		$user = Container::getModel('User');

		if (array_count_values($_POST)) {

			$day = (int) $_POST['day'];
			$month = (int) $_POST['month'];
			$year = (int) $_POST['year'];

			$birthday = $day . '-' . explode(" ", $month + 1)[0] . '-' . $year;

			$user->__set('name', $_POST['name']);
			$user->__set('email', $_POST['email']);
			$user->__set('birthday', $birthday);
			$user->__set('address', $_POST['address']);
			$user->__set('day', $_POST['day']);
			$user->__set('month', explode(" ", $_POST['month'])[1]);
			$user->__set('year', $_POST['year']);
			$user->__set('phone_number', $_POST['phone_number']);
			$user->__set('password', $_POST['password']);


			if ($user->validateRegister() == 1) {
				//echo "<p style='color:green'>1 etapa: passou</p>";

				if ($user->userRegister() == true) {
					//echo "<p style='color:red'>email ja foi registrado</p>";
					$this->view->errorEmailExist = true;
					$this->view->errorCadastro = false;

					$this->render('index');
				} else {

					$user->handlingImageUpload();
					$user->uploadImage();
					$user->saveRegister();

					// echo '<pre>';
					// print_r($user);
					// echo '</pre>';
					echo "<p style='color:green'>2 etapa: registro efetuado</p>";
					$this->view->corrector = true;
					$this->render('cadastrado');
				}
			} else {
				//echo "<p style='color:red'>dados incompletos</p>";

				echo '<pre>';
				print_r($user);
				echo '</pre>';

				$user = array(
					'email' => '',
					'password' => '',
				);

				$this->view->user = $user;
				$this->view->errorEmailExist = false;
				$this->view->errorCadastro = true;
				$this->view->errorName = false;


				$this->render('index');
				//header("Location: " . $_SERVER['HTTP_REFERER'] . "");
			}


			echo '<pre>';
			//print_r($uploadException);
			echo '</pre>';

			// echo '<pre>';
			// print_r($_FILES);
			// echo '</pre>';



			// if ($_FILES['userfile']['error'] === UPLOAD_ERR_OK) {
			// 	echo 'uploading successfully done';
			// } else {
			// 	throw new UploadException($_FILES['userfile']['error']);
			// }

			//$user->createUser();


		}
	}

	public function checkedAuth()
	{

		session_start();

		if (!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['name']) || $_SESSION['name'] == '') {
			//header('Location: /?login=erro');
			//echo 'nao';
		} else {
			header('Location: /home');
		}
	}
	public function error()
	{

		echo '404';
	}
}

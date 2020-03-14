<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action
{


    // public function auth()
    // {

    //     $usuario = Container::getModel('User');

    //     $usuario->__set('email', $_POST['email']);
    //     $usuario->__set('senha', md5($_POST['senha']));

    //     $usuario->auth();

    //     if ($usuario->__get('id') != '' && $usuario->__get('nome')) {

    //         session_start();

    //         $_SESSION['id'] = $usuario->__get('id');
    //         $_SESSION['nome'] = $usuario->__get('nome');

    //         header('Location: /timeline');
    //     } else {
    //         echo 'senha errada';
    //         print_r($_POST);
    //         $this->render('index');

    //         //header('Location:login?404=erro');
    //     }
    // }

    public function login()
    {
        $user = Container::getModel('User');

        $user->__set('email', $_POST['email']);
        $user->__set('password', $_POST['password']);

        // echo '<pre>';
        // print_r($user);
        // echo '</pre>';

        $user->getUser();


        // echo '<pre>';
        // print_r($user);
        // echo '</pre>';



        if ($user->__get('id') != '' && $user->__get('name')) {

            session_start();

            $_SESSION['id'] = $user->__get('id');
            $_SESSION['name'] = $user->__get('name');

            header('Location: /home');
        } else {
            echo 'senha errada <br>';
            //print_r($this->render('oi'));
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
        //$uploadException = Container::getModel('UploadException');

        if (array_count_values($_POST)) {
            $mes = explode(" ", $_POST['month']);
            $d = $_POST['day'] . '-' . explode(" ", $_POST['month'])[0] . '-' . $_POST['year'];

            $user->__set('name', $_POST['name']);
            $user->__set('email', $_POST['email']);
            $user->__set('birthday', $d);
            $user->__set('address', $_POST['address']);
            $user->__set('day', $_POST['day']);
            $user->__set('month', explode(" ", $_POST['month'])[1]);
            $user->__set('year', $_POST['year']);
            $user->__set('phone_number', $_POST['phone_number']);
            $user->__set('password', $_POST['password']);

            if ($_FILES['userfile']['error'] == 4) {
                echo 'nenhuma imagem enviada';
            }

            if ($_FILES['userfile']['error'] == 2) {
                echo 'imagem muito grande';
            }

            if ($_FILES['userfile']['error'] == 0) {
                echo 'upload feito com sucesso';

                $user->__set('image', $_FILES['userfile']['name']);
                $user->__set('type', $_FILES['userfile']['type']);
                $user->__set('tmp_name', $_FILES['userfile']['tmp_name']);
                $user->__set('error', $_FILES['userfile']['error']);
                $user->__set('size', $_FILES['userfile']['size']);
            }

            // echo '<pre>';
            // print_r($user);
            // echo '</pre>';

            if ($user->validateRegister() == 1) {
                //echo "<p style='color:green'>1 etapa: passou</p>";

                if ($user->userRegister() == true) {
                    echo "<p style='color:red'>email ja foi registrado</p>";
                    $this->view->errorEmailExist = true;
                    $this->view->errorCadastro = false;

                    $this->render('index');
                } else {
                    //$user->createUser();
                    $user->saveRegister();
                    echo "<p style='color:green'>2 etapa: registro efetuado</p>";
                    $this->view->corrector = true;
                    //$this->render('cadastrado');
                }
            } else {
                echo "<p style='color:red'>dados incompletos</p>";
                $this->view->errorCadastro = true;
                $this->view->errorEmailExist = false;

                $this->render('index');
                //header("Location: " . $_SERVER['HTTP_REFERER'] . "");
            }
        } else {
            //echo 'nao tem';
            $this->view->errorCadastro = false;
            $this->view->errorEmailExist = false;

            $this->render('index');
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
    public function sair()
    {
        session_start();
        session_destroy();
        //echo 'oi';
        header('Location: /');
        //$this->render('index');
    }
}

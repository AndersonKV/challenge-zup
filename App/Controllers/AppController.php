<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action
{


    public function home()
    {
        // session_start();
        // session_destroy();

        $this->checkedAuth();


        $getUser = Container::getModel('User');
        $myUser = Container::getModel('User');


        $user = $getUser->getAllUsers();
        $myUser->__set('id_usuario', $_SESSION['id']);

        $this->view->user = $user;

        //$fileDestination = __DIR__ . '/../../upload/'; //. $user[2]['image'];
        //$this->view->$fileDestination = $fileDestination;



        $this->render('home');
    }

    public function search()
    {
        $this->checkedAuth();
        $user = Container::getModel('User');

        $getUser = $user->searchUser($_POST['search']);
        // $user
        $this->view->user = $getUser;

        // echo '<pre>';
        // print_r($getUser);
        // echo '</pre>';


        //echo 'ESTAMOS NA ROTA SEARCH';
        $this->render('search');
    }
    public function sair()
    {
        session_start();
        session_destroy();

        $this->checkedAuth();
    }

    public function trash()
    {
        $this->checkedAuth();

        $getUser = Container::getModel('User');
        $user = $getUser->getAllUsers();

        $this->view->user = $user;


        //$this->view->user = $user;


        $this->render('trash');
    }
    public function setTrash()
    {
        $this->checkedAuth();

        $user = Container::getModel('User');

        $update = 'trash';
        $id = $_POST['trash'];

        $user->update($id, $update);

        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';


        echo 'ESTAMOS NA ROTA trash';
    }

    public function todo()
    { }
    public function setTodo()
    {
        $this->checkedAuth();

        $user = Container::getModel('User');

        $update = null;
        $id = $_POST['todo'];

        $user->update($id, $update);
    }
    public function attended()
    {
        $this->checkedAuth();


        $getUser = Container::getModel('User');
        $user = $getUser->getAllUsers();

        $this->view->user = $user;


        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';


        $this->render('attended');
    }
    public function setAttended()
    {
        $this->checkedAuth();

        $user = Container::getModel('User');

        $update = 'attended';
        $id = $_POST['attended'];

        $user->update($id, $update);
    }
    public function screen()
    {
        //echo 'oi';
        $this->checkedAuth();
        $getUser = Container::getModel('User');

        $url = $_SERVER["REQUEST_URI"];
        //pega as infos para fazer a requisição 
        $newString = substr($url, 9);
        $userInfo = explode("/", $newString);
        $getUser->__set('id', $userInfo[0]);


        $user = $getUser->getUser();
        $this->view->user = $user;



        // echo 'rota screen';
        $this->render('screen');

        //header("Location: " . $_SERVER['HTTP_REFERER'] . "");
    }


    public function ops()
    {
        $this->render('ops');
        echo 'ROTA OPS';
    }

    public function checkedAuth()
    {

        session_start();

        if (!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['name']) || $_SESSION['name'] == '') {
            header('Location: /?login=erro');
        }
    }
}

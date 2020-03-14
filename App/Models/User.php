<?php

namespace App\Models;

use MF\Model\Model;

class User extends Model
{

    private $id;
    private $name;
    private $email;
    private $birthday;
    private $password;
    private $address;
    private $day;
    private $month;
    private $year;
    private $phone_number;
    private $file;
    private $update;
    private $idUpdate;

    private $image;
    private $type;
    private $tmp_name;
    private $error;
    private $size;

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function auth()
    {
        $query = "select id, name, email from zup_user where email = :email and password = :password";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->bindValue(':password', $this->__get('password'));
        $stmt->execute();

        $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($usuario['id'] != '' && $usuario['name'] != '') {
            $this->__set('id', $usuario['id']);
            $this->__set('name', $usuario['name']);
        }
        return $this;
    }
    //faz a verificação da imagem
    public function handlingImageUpload()
    {


        if ($_FILES['userfile']['error'] == 4) {
            //echo 'nenhuma imagem enviada';
            //$this->image = 'imagemDefault.jpg';
            $this->__set('image', 'imagemDefault.jpg');
        }

        if ($_FILES['userfile']['error'] == 2) {
            echo 'imagem muito grande';
        }

        if ($_FILES['userfile']['error'] == 0) {
            echo 'upload feito com sucesso';

            $this->__set('image', $_FILES['userfile']['name']);
            $this->__set('type', $_FILES['userfile']['type']);
            $this->__set('tmp_name', $_FILES['userfile']['tmp_name']);
            $this->__set('error', $_FILES['userfile']['error']);
            $this->__set('size', $_FILES['userfile']['size']);
            //$user->uploadImage();
            //echo $_FILES['userfile']['name'];
        }
    }
    //faz a verificação da imagem se foi enviada ou não
    public function uploadImage()
    {
        if (file_exists($_FILES['userfile']['tmp_name']) || is_uploaded_file($_FILES['userfile']['tmp_name'])) {

            echo '<br>////////////////existe/////////' . '<br>';

            // echo '<pre>';
            // print_r($_FILES);
            // echo '</pre>';

            //pega a imagem enviada
            $file = $_FILES['userfile'];
            //pega todos os sub-name
            $fileName = $_FILES['userfile']['name'];
            $fileType = $_FILES['userfile']['type'];
            $fileTmpName = $_FILES['userfile']['tmp_name'];
            $fileError = $_FILES['userfile']['error'];
            $fileSize = $_FILES['userfile']['size'];


            //excluir a virgula
            $fileExt = explode('.', $fileName);
            //diminui o tamanho do texto
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png', 'pdf');

            //checa se se fileActualExt existe no array jpg,etc
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    //se tamanho do arquivo for menor que 1gb passa
                    if ($fileSize < 1000000) {
                        //cria um nome unico
                        $fileNameNew = uniqid('', true) . "." . $fileActualExt;

                        $fileDestination = __DIR__ . '/../../public/assets/upload/' . $fileNameNew;

                        move_uploaded_file($fileTmpName, $fileDestination);
                        echo 'Uploaded <br>';
                        //header("location: /");
                        //$this->__set('image', $fileNameNew);
                        return $this->__set('image', $fileNameNew);;
                        // echo $fileNameNew . '<br>';
                        // echo $fileDestination . '<br>';
                    } else {
                        echo 'sua imagem é muito grande';
                    }
                } else {
                    echo 'erro ao enviar imagem';
                }
            } else {
                echo $fileActualExt;
                echo ' você não pode enviar esse tipo de imagem';
            }
        } else {
            echo 'nenhuma imagem enviada';
        }
    }
    //salva no banco de dados o usuario
    public function saveRegister()
    {

        $query = "insert into zup_user
        (image, name, email, birthday, address, phone_number, password) 
            VALUES 
        ('$this->image', '$this->name','$this->email', '$this->birthday', 
        '$this->address','$this->phone_number','$this->password')";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    //validar se um cadastro pode ser feito
    public function validateRegister()
    {
        $valido = true;
        global $errorName;

        if (strlen($this->__get('name')) < 3) {
            $valido = false;
        }

        if (strlen($this->__get('email')) < 3) {
            $valido = false;
        }

        if (strlen($this->__get('password')) < 3) {
            $valido = false;
        }

        if (strlen($this->__get('address')) < 6) {
            $valido = false;
        }

        if (strlen($this->__get('phone_number')) <= 10) {
            $valido = false;
        }

        //echo 'estamos no validateEmail . <br>';

        return $valido;
    }

    //recuperar um usuário por e-mail
    public function userRegister()
    {

        // echo '<pre>';
        // print_r($this);
        // echo '</pre>';
        //echo 'estamos no userRegister . <br>';
        $email = $this->email;

        $query = "SELECT email FROM zup_user WHERE email = '$email' ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    //pega todos os usuarios registrados
    public function getAllUsers()
    {

        $query = "select * from zup_user";
        $stmt = $this->db->prepare($query);
        //$stmt->bindValue(':email', $this->__get('email'));
        //$stmt->bindValue(':password', $this->__get('password'));
        $stmt->execute();
        $user = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $user;
    }
    public function getUser()
    {

        $query = "select * from zup_user where id = '{$this->id}' ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);;
    }
    public function update($id, $update)
    {
        //$update;
        $query =  "UPDATE zup_user SET todo = '$update' WHERE id = '$id' ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $user;
    }
    public function searchUser($user)
    {

        $query = "SELECT * FROM `zup_user` WHERE name like '%$user%' ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();


        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}

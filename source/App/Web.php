<?php

namespace Source\App;

use League\Plates\Engine;
use Source\Models\User;
use Source\Models\Faq;

class Web
{

    private $view;

    public function __construct()
    {
        $this->view = new Engine(CONF_VIEW_WEB,"php");
    }

    public function home()
    {
        echo $this->view->render("home");
    }

    public function about()
    {
        echo $this->view->render("about");
    }

    public function contact ()
    {
        echo $this->view->render("contact",[]);
    }

    public function faq ()
    {
        $faqs = new Faq();
        echo $this->view->render("faq",["faqs" => $faqs->selectAll()]);
    }

    public function login () 
    {
        echo $this->view->render("login");
    }

    public function loginPost (array $data)
    {
        if ($data) {
            
            $email = $data["login-email"];
            $password = $data["login-password"];
    
            $user = new User();
    
            $returnValidate = $user->validateUser($email, $password);
    
            if ($returnValidate == true) {
    
                $userJson = [
                    "code" => 200,
                    "type" => "success",
                    "message" => "Usuário logado com sucesso!"
                ];
    
                echo json_encode($userJson);
            } else {
                $userJson = [
                    "code" => 400,
                    "type" => "bad_request",
                    "message" => "Não foi possível realizar esta ação :("
                ];
                echo json_encode($userJson);
            }
        }
    }

    public function signUp ()
    {
        echo $this->view->render("signUp");
    }

    public function signUpPost (array $data)
    {
        if (!empty($data)) {
            $user = new User(
                $data['register-email'],
                $data['register-name'],
                $data['register-phoneNumber'],
                $data['register-password']
            );

            $returnInsert = $user->insertUser();

            if ($returnInsert == true) {
                $userJson = [
                    "code" => 200,
                    "type" => "success",
                    "message" => "Usuário cadastrado com sucesso!"
                ];
                echo json_encode($userJson);
            } else {
                $userJson = [
                    "code" => 400,
                    "type" => "bad_request",
                    "message" => "Não foi possível realizar esta ação :("
                ];
                echo json_encode($userJson);
                return;
            }
        } 
    }

    public function error (array $data) : void
    {
        var_dump($data);
    }



}
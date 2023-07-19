<?php

namespace Source\App;

use League\Plates\Engine;
use Source\Models\User;
use Source\Models\Faq;
use Source\Models\Recipe;

class App
{
    private $view;

    public function __construct()
    {
        if (empty($_SESSION["user"]) && empty($_COOKIE['userName'])) {
            header("location:". url("login"));
        } 

        $this->view = new Engine(CONF_VIEW_APP, 'php');
    }

    public function home () : void 
    {
        echo $this->view->render("home");
    }

    public function recipes () : void 
    {   
        $recipes = new Recipe();
        echo $this->view->render("recipes",["recipes" => $recipes->selectAll()]);
    }

    public function profile () : void 
    {
        $user = new User();
        if (!isset($_SESSION['user']['id'])) {
            $id = $_COOKIE['userId'];
        } else {
            $id = $_SESSION['user']['id'];
        }
        
        $userLoged = $user->selectUser($id);

        echo $this->view->render("profile",[ "userLoged" => $userLoged ]);
    }

    public function profilePost (array $data) 
    {
        if(!empty($data)){

            $user = new User(
                $data['edit-email'], 
                $data['edit-name'], 
                $data['edit-phoneNumber']
            );

            $returnInsert = $user->updateUser($data['edit-id']);

            if ($returnInsert == true) {
                $userJson = [
                    "code" => 200,
                    "type" => "success",
                    "message" => "Alterações realizadas com sucesso!"
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
            return;
        } 
    
    }


    /* SAME AS WEB */

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


    public function logout () : void 
    {
        session_destroy();
        setcookie("userId", "", time()-3600, "/");
        setcookie("userName", "", time()-3600, "/");
        header("location:". url(""));
    }

}
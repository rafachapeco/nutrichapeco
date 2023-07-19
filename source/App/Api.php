<?php

namespace Source\App;

use Source\Models\User;

class Api
{
    public function __construct()
    {
        header('Content-Type: application/json; charset=UTF-8');
    }

    public function getUsers()
    {
        $key = "kIJslosm@782";
        $headers = getallheaders();

        if ($headers["Key"] == $key) {
            $users = new User();
            echo json_encode($users->selectAllUsers(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } else {
            $response = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Informe a chave de acesso!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }
    }
}
<?php

namespace Source\Models;

use Source\Core\Connect;

class User
{
    private $id;
    private $email;
    private $name;
    private $phoneNumber;
    private $password;
    /**
     * @param $email mixed 
     * @param $name mixed 
     * @param $phoneNumber mixed 
     * @param $password mixed 
     */
    function __construct(
        ?string $email = NULL,
        ?string $name = NULL,
        ?string $phoneNumber = NULL,
        ?string $password = NULL
    ) {

        $this->email = $email;
        $this->name = $name;
        $this->phoneNumber = $phoneNumber;
        $this->password = $password;
    }

    public function insertUser(): bool
    {
        $query = "INSERT INTO users VALUES (NULL, :email, :name, :phoneNumber, :password, NULL, NULL)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":phoneNumber", $this->phoneNumber);
        $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt->bindParam(":password", $passwordHash);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $arrayUser = [
                "id" => Connect::getInstance()->lastInsertId(),
                "name" => $this->name,
                "email" => $this->email
            ];

            $_SESSION["user"] = $arrayUser;
            setcookie("userId", Connect::getInstance()->lastInsertId(), time() + 60 * 60 * 24, "/");
            setcookie("userName", $this->name, time() + 60 * 60 * 24, "/");

            return true;
        } else {
            return false;
        }
    }

    public function validateUser(string $email, string $password): bool
    {
        $query = "SELECT * FROM users WHERE email LIKE :email";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch();
            if (password_verify($password, $user->password)) {
                $arrayUser = [
                    "id" => $user->id,
                    "name" => $user->name,
                    "email" => $email
                ];
                $_SESSION["user"] = $arrayUser;
                setcookie("userId", $user->id, time() + 60 * 60 * 24, "/");
                setcookie("userName", $user->name, time() + 60 * 60 * 24, "/");

                $this->id = $user->id;
                $this->email = $user->email;
                $this->name = $user->name;
                $this->phoneNumber = $user->phoneNumber;
                $this->password = $user->phoneNumber;

                return true;
            }
            return false;
        } else {
            return false;
        }
    }

    public function updateUser(int $id)
    {
        $query = "UPDATE users SET email = :email, name = :name, phoneNumber = :phoneNumber WHERE id = :id";

        $stmt1 = Connect::getInstance()->prepare($query);
        $stmt1->bindParam(":email", $this->email);
        $stmt1->bindParam(":name", $this->name);
        $stmt1->bindParam(":phoneNumber", $this->phoneNumber);
        $stmt1->bindParam(":id", $id);
        $stmt1->execute();

        if ($stmt1->rowCount() == 1) {
            $arrayUser = [
                "id" => $id,
                "name" => $this->name,
                "email" => $this->email,
                "phone" => $this->phoneNumber
            ];
            $_SESSION["user"] = $arrayUser;
            return true;
        } else {
            return false;
        }
    }

    public function selectUser(int $id)
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($stmt->rowCount() == 1) {

            $this->id = $user->id;
            $this->email = $user->email;
            $this->name = $user->name;
            $this->phoneNumber = $user->phoneNumber;

            return $user;
        } else {
            return false;
        }
    }

    public function selectAllUsers()
    {
        $query = "SELECT * FROM users";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    public function getArray(): array
    {
        return ["user" => [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "email" => $this->getEmail(),
            "phoneNumber" => $this->getPhoneNumber()
        ]];
    }
}

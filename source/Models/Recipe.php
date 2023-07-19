<?php

namespace Source\Models;

use Source\Core\Connect;

class Recipe
{
    private $name;
    private $description;

    public function __construct($name = null, $description = null)
    {
        $this->name= $name;
        $this->description = $description;
    }

    public function selectAll ()
    {
        $query = "SELECT * FROM recipes";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }
    }

}
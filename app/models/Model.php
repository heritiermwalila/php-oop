<?php
namespace App\models;

class Model
{

    public function findById($id)
    {
        echo $id;
    }
    public function findOne($instance)
    {
        echo $instance;
    }

    public function findMany()
    {
        echo "Find many";
    }
}
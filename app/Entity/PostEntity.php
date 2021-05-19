<?php
namespace App\Entity;

class PostEntity {

    public function getUrl()
    {
        return 'index.php?page=post&id=' . $this->id;
    }

}
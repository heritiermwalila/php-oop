<?php
namespace App\Entity;

use Core\Entity\Entity;

/**
 * Class PostEntity
 * @package App\Entity
 */
class PostEntity extends Entity {
    public $id;

    /**
     * Get URL, get loaded by a magic method __get from Entity class
     * @return string
     */
    public function getUrl(): string
    {
        return 'index.php?page=posts.show&id=' . $this->id;
    }



}
<?php
namespace App\Model;

use Core\Helper;
use Core\Model\Model;

/**
 * Class PostModel
 * @package App\Model
 */
class PostModel extends Model {
    /**
     * DB Table name
     * @var string
     */
    protected $table = 'posts';

    public function findByCategory(int $id)
    {
        $statement = $this->sql->prepare($this->table, ['category_id'])->get();

        return $this->db->prepare($statement, [':category_id'=>$id], str_replace('Model', 'Entity', __CLASS__));
    }
    
}

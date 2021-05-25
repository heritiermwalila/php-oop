<?php
namespace App\Model;

use Core\Facades\Query;
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

    public function findAll()
    {
        $query = Query::select('id, title')
                ->from('posts', 'p')
                // ->join('categorie', 'c', 'on', 'c.id = p.category_id')
                ->where('p.id > 1')
                ->where('p.title = "testing"')
                ->get();
    }
    
}

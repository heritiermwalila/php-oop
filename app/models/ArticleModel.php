<?php
namespace App\models;

use Core\models\Model;

class ArticleModel extends Model {
    protected $table = 'articles';
    
}

//namespace App\models;
//use App\core;
//use App\Helper;
//
//class Article extends Model
//{
//     protected static $table = 'articles';
//
//     public function __get($key)
//     {
//         $method = 'get' . ucfirst($key);
//         return $this->$method();
//     }
//
//     public function getUrl()
//     {
//         return '?p=post&id=' . $this->id;
//     }
//}
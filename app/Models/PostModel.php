<?php namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model{
  protected $table = 'post';
  protected $primaryKey = 'id';
  protected $allowedFields = ['nome','descricao','blog_post_id'];
  protected $returnType    = 'App\Entities\PostEntity';
}

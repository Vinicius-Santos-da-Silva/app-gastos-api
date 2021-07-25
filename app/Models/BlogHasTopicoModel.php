<?php namespace App\Models;

use CodeIgniter\Model;

class BlogHasTopicoModel extends Model{
  protected $table = 'blog_has_topico';
  protected $primaryKey = 'id';
  protected $allowedFields = ['blog_post_id','topico_id'];
  protected $returnType    = 'App\Entities\BlogHasTopicoEntity';
}

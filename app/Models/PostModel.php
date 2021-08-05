<?php namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model{
  protected $table = 'post';
  protected $primaryKey = 'id';
  protected $allowedFields = ['nome','descricao','blog_post_id'];
  protected $returnType    = 'App\Entities\PostEntity';

  protected $useSoftDeletes = true;
  protected $useTimestamps = true;
  protected $createdField  = 'datahora_criacao';
  protected $updatedField  = 'datahora_atualizacao';
  protected $deletedField  = 'datahora_desativacao';

}

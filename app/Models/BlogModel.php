<?php namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model{
    protected $table = 'blog';
    protected $primaryKey = 'post_id';
    protected $allowedFields = ['post_title','post_description','post_featured_image' , 'is_free' , 'slug'];
    protected $returnType    = 'App\Entities\BlogEntity';

    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField  = 'datahora_criacao';
    protected $updatedField  = 'datahora_atualizacao';
    protected $deletedField  = 'datahora_desativacao';

}

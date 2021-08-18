<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['firstname','lastname','email' , 'premium'];

    protected $returnType    = 'App\Entities\UsuarioEntity';

    protected $useSoftDeletes = false;
    protected $useTimestamps = true;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

}

<?php namespace App\Models;

use CodeIgniter\Model;
use App\Entities\TopicoEntity;

class TopicoModel extends Model{
    
    protected $table = 'topico';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'nome',
        'pai',
        'filho'
    ];

    protected $returnType    = 'App\Entities\TopicoEntity';
}

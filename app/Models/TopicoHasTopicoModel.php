<?php namespace App\Models;

use CodeIgniter\Model;

class TopicoHasTopicoModel extends Model{
    protected $table = 'topico_has_topico';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'topico_id',
        'topico_id1',
    ];
}

<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\TopicoHasTopicoModel;
use App\Models\TopicoModel;
use App\Models\BlogHasTopicoModel;
use App\Models\BlogModel;
use App\Models\PostModel;

class UsuarioEntity extends Entity
{
    protected $attributes = [
        'firstname'=> null,
        'lastname'=> null,
        'password' => null,
        'email' => null,
        'premium' => null,
    ];

    public function isPremium() {

        return $this->attributes['premium'];
    }

}
<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\TopicoHasTopicoModel;
use App\Models\TopicoModel;
use App\Models\BlogHasTopicoModel;
use App\Models\BlogModel;
use App\Models\UsuarioModel;

class UsuarioEntity extends Entity
{
    protected $attributes = [
        'firstname'=> null,
        'lastname'=> null,
        'password' => null,
        'email' => null,
        'premium' => null,
        'admin' => null,
    ];

    public function isPremium() {

        return $this->attributes['premium'];
    }

    public function hiddenPassaword() {

        if(!isset($this->attributes['password'])) {
        
            return $this;
        }

        unset($this->attributes['password']);

        return $this;
    }

    public function setAdmin($valor) 
    {

        if ($valor == null) {

            return $this;

        }

        $this->attributes['admin'] = boolval($valor);

        return $this;
    }

    public function setPremium($valor) 
    {

        if ($valor == null) {

            return $this;

        }

        $this->attributes['premium'] = boolval($valor);

        return $this;
    }

    public function save() 
    {
        $model = new UsuarioModel();

        $model->save($this->attributes);
    }
    

    

}
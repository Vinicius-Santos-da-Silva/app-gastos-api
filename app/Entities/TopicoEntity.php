<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\TopicoHasTopicoModel;
use App\Models\TopicoModel;

class TopicoEntity extends Entity
{
    protected $attributes = [
        'id' => null,
        'nome' => null,
        'datahora_cadastro' => null,
        'datahora_desativacao' => null,
        'pai' => null,
        'filho' => null,
        'filhos' => [],
    ];


    public function setPassword(string $pass)
    {
        $this->attributes['password'] = password_hash($pass, PASSWORD_BCRYPT);

        return $this;
    }

    public function getId()
    {
        return $this->attributes['id'];
    }
    
    public function setId(int $id)
    {
        $this->attributes['id'] = intval($id);

        return $this;
    }

    public function setNome(string $nome)
    {
        $this->attributes['nome'] = $nome;
        
        return $this;
    }

    public function setDatahoraCadastro()
    {        
        $this->attributes['datahora_cadastro'] = new Time(date('d/m/Y H:i:s', time()), 'UTC');

        return $this;
    }

    public function setIsPai(boolean $bool)
    {        
        $this->attributes['pai'] = $bool;

        return $this;
    }

    public function setIsFilho(boolean $bool)
    {        
        $this->attributes['filho'] = $bool;

        return $this;
    }

    public function getDepedents() {
        return $this->attributes['filhos']; 
    }

    public function findDepents() {

        
        $model = new TopicoHasTopicoModel();
        $model2 = new TopicoModel();

        $this->attributes['filhos'] = [];

        $filhos_relacionados = $model->where(['topico_id' => $this->getId()])->find();
        

        foreach ($filhos_relacionados as $key => $value) {
            
            $filho = $model2->find($value['topico_id1']);
            
            $filho->findDepents();

            $this->attributes['filhos'][] = $filho;
        }
    }


}
<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\TopicoHasTopicoModel;
use App\Models\TopicoModel;
use App\Models\BlogModel;

class PostEntity extends Entity
{
    protected $attributes = [
        'nome' => null,
        'description' => null,
        'blog_post_id' => null,
    ];
    
}

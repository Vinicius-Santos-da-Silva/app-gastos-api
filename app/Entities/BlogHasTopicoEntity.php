<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\TopicoHasTopicoModel;
use App\Models\TopicoModel;
use App\Models\BlogModel;

class BlogHasTopicoEntity extends Entity
{
    protected $attributes = [
        'blog_post_id' => null,
        'topico_id' => null,
    ];

    public function getPost() {
        $model = new BlogModel();
        return $model->find($this->attributes['blog_post_id']);
    }
}

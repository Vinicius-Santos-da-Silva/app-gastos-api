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
        'blog' => null,
        'topico' => null
    ];

    public function getPost() {
        $model = new BlogModel();
        return $model->find($this->attributes['blog_post_id']);
    }

    public function findBlog() {
        $blog = $this->getPost();
        $this->attributes['blog'] = $blog;
        return $this;
    }

    public function getTopico() {
        $model = new TopicoModel();
        return $model->find($this->attributes['topico_id']);
    }

    public function findTopico() {

        $topico = $this->getTopico();
        
        $this->attributes['topico'] = $topico;
        
        return $this;
    }
}

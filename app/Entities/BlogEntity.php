<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\TopicoHasTopicoModel;
use App\Models\TopicoModel;
use App\Models\BlogHasTopicoModel;
use App\Models\BlogModel;
use App\Models\PostModel;

class BlogEntity extends Entity
{
    protected $attributes = [
        'post_title'=> null,
        'post_description'=> null,
        'post_featured_image' => null,
        'is_free' => null,
        'slug' => null,
        'topico' => null
    ];

    
    public function findPosts() {

        $post_model = new PostModel();

        $this->attributes['posts'] = $post_model->where(['blog_post_id' => $this->attributes['post_id']])->find();
    
        return $this;
    }

    public function findTopicoPai() 
    {
        $model = new BlogHasTopicoModel();
    
        $topico = $model
            ->where(['blog_post_id' => $this->attributes['post_id']])
            ->first();

        if(!$topico) {
            return $this;
        }

        $this->attributes['topico'] = $topico->findTopico();
        
        return $this;
    }

    public function isPremium() {
        return !boolval($this->attributes['is_free']);
    }


}
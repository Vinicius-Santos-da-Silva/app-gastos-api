<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\TopicoHasTopicoModel;
use App\Models\TopicoModel;
use App\Models\BlogModel;
use App\Models\PostModel;

class BlogEntity extends Entity
{
    protected $attributes = [
        'post_title'=> null,
        'post_description'=> null,
        'post_featured_image' => null,
        'is_free' => null,
        'slug' => null
    ];

    

    public function findPosts() {

        $post_model = new PostModel();

        $this->attributes['posts'] = $post_model->where(['blog_post_id' => $this->attributes['post_id']])->find();
    
        return $this;
    }
}

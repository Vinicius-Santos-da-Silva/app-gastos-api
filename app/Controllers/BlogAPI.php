<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\BlogModel;

class BlogAPI extends \CodeIgniter\Controller
{
    use ResponseTrait;

    public function slug($slug=null)
    {
        $model = new BlogModel();
        $data  = $model->where(['slug' => $slug])->first();

		if (!$data) {
			return $this->failNotFound('Conteudo não existe ou está cancelado.');
		}

		return $this->respond($data);
    }
}
<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\BlogModel;
use App\Models\TopicoModel;
use App\Models\TopicoHasTopicoModel;


class BlogAPI extends BaseController
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

    public function include($id=null) {

        $model = new TopicoModel();
        $model_has = new TopicoHasTopicoModel();

        $topico = $model->find($id);

        if(!$topico) {
            return $this->failNotFound('Tópico inválido.');
        }

        $topico_id = $this->request->getPost('topico_id');
        $topico_relacionado = $model->find($topico_id);


        $topico->addTopico($topico_relacionado);
        
		return $this->respond(['status' => 'ok']);
	}

    public function exclude($id=null , $topico_id) {

        $model = new TopicoModel();
        $model_has = new TopicoHasTopicoModel();

        $topico = $model->find($id);

        if(!$topico) {
            return $this->failNotFound('Tópico inválido.');
        }

        $topico_relacionado = $model->find($topico_id);


        $topico->removeTopico($topico_relacionado);
        
		return $this->respond(['status' => 'ok']);
	}
}
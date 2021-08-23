<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\TopicoHasTopicoModel;

class Topico extends ResourceController
{
	protected $modelName = 'App\Models\TopicoModel';
	protected $format = 'json';

	public function index(){
        
        $topico_has_topico_model = new TopicoHasTopicoModel();

		// $topicos = $this->model->where(['pai' => 1 , 'filho' => 0])->find();
		$topicos = $this->model->find();
        
        foreach ($topicos as $k => $topico) {
            
            $topicos[$k]->findDepents();

        }
		
		return $this->respond($topicos);
	}

	public function show($id = null){
		
		$topico = $this->model->find($id);

		if(!$topico) {
			return $this->failNotFound('Item not found');
		}

		$topico->findDepents();

		return $this->respond($topico);
	}

	public function create(){
		helper(['form']);

		$rules = [
			'title' => 'required|min_length[6]',
			'description' => 'required',
			// 'featured_image' => 'uploaded[featured_image]|max_size[featured_image, 1024]|is_image[featured_image]'
		];

		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else{

			$data = [
				'post_title' => $this->request->getVar('title'),
				'post_description' => $this->request->getVar('description'),
			];

			$post_id = $this->model->insert($data);
			
			$data['post_id'] = $post_id;

			return $this->respondCreated($data);
		}
	}

	public function update($id = null){
		helper(['form', 'array']);

		$rules = [
			'nome' => 'required|min_length[2]',
		];

		if(!$this->validate($rules)){	
			return $this->fail($this->validator->getErrors());
		}

		$data = [
			'id' => $id , 
			'nome' => $this->request->getVar('nome'),
		];

		$this->model->save($data);

		return $this->respond($data);

	}

	public function delete($id = null){
		$data = $this->model->find($id);

		if($data){

			$this->model->delete($id);

			return $this->respondDeleted($data);
		}

		return $this->failNotFound('Item not found');
	}

	public function search()
	{
		$q = $this->request->getVar('q');

		$resultado = $this->model->like('nome' , $q)->find();

		return $this->respond($resultado);
	}



	//--------------------------------------------------------------------

}

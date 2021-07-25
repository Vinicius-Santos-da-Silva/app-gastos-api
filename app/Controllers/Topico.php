<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\TopicoHasTopicoModel;

class Topico extends ResourceController
{
	protected $modelName = 'App\Models\TopicoModel';
	protected $format = 'json';

	public function index(){
        
        $topico_has_topico_model = new TopicoHasTopicoModel();

		$topicos = $this->model->where(['pai' => 1 , 'filho' => 0])->find();
        
        foreach ($topicos as $k => $topico) {
            
            $topicos[$k]->findDepents();

        }
		
		return $this->respond($topicos);
	}

	public function show($id = null){
		
		$topico = $this->model->find($id);

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
			'title' => 'required|min_length[6]',
			'description' => 'required',
			'is_free' => 'required',
		];


		$fileName = dot_array_search('featured_image.name', $_FILES);

		if($fileName != ''){
			$img = ['featured_images' => 'uploaded[featured_image]|max_size[featured_image, 1024]|is_image[featured_image]'];
			$rules = array_merge($rules, $img);
		}



		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else{
			//$input = $this->request->getRawInput();



			$data = [
				'post_id' => $id,
				'post_title' => $this->request->getVar('title'),
				'post_description' => $this->request->getVar('description'),
				'is_free' => $this->request->getVar('is_free'),
			];

			if($fileName != ''){

				$file = $this->request->getFile('featured_image');
				if(! $file->isValid())
					return $this->fail($file->getErrorString());

				$file->move('./assets/uploads');
				$data['post_featured_image'] = $file->getName();
			}

			$this->model->save($data);
			return $this->respond($data);
		}

	}

	public function delete($id = null){
		$data = $this->model->find($id);
		if($data){
			$this->model->delete($id);
			return $this->respondDeleted($data);
		}else{
			return $this->failNotFound('Item not found');
		}
	}



	//--------------------------------------------------------------------

}

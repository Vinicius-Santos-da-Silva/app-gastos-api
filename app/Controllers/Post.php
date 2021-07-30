<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Post extends ResourceController
{
	protected $modelName = 'App\Models\PostModel';
	protected $format = 'json';

	public function index(){
		$limit = $this->request->getVar("limit");
		$offset = $this->request->getVar("offset");

		if(!$limit) {
			$limit = 10;
		}
		
		if(!$offset) {
			$offset = 0;
		}

		$posts = $this->model->findAll($limit , $offset);
		
		$all_results = $this->model->countAllResults();

		$to = $offset+$limit;
		
		if($to > $all_results) {
			$to = $to + ($all_results - $to);
		}
		
		$response = array(
			'data' => $posts,
			'total_pages' => ceil($all_results/$limit),
			'total' => $all_results,
			'from' => $offset+1,
			'to' => $to,
			'limit' => 10,
		);

		return $this->respond($response);
	}

	public function create(){
		helper(['form']);

		$rules = [
			'nome' => 'required|min_length[6]',
			'descricao' => 'required',
			'blog_post_id' => 'required',
		];

		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}

        $data = [
            'nome' => $this->request->getVar('nome'),
            'descricao' => $this->request->getVar('descricao'),
            'blog_post_id' => $this->request->getVar('blog_post_id'),
        ];

        $post_id = $this->model->insert($data);
        
		$post = $this->model->find($post_id);
        
        return $this->respondCreated($post);
    }

	public function show($id = null){
		$data = $this->model->find($id);
		return $this->respond($data);
	}

	public function update($id = null){
		helper(['form', 'array']);

		$rules = [
			'nome' => 'required|min_length[4]',
			'descricao' => 'required|min_length[3]',
		];

		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}
			
        $data = [
            'id' => $id,
            'nome' => $this->request->getVar('nome'),
            'descricao' => $this->request->getVar('descricao'),
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



	//--------------------------------------------------------------------

}

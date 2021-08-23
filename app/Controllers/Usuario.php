<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\TopicoHasTopicoModel;

class Usuario extends ResourceController
{
	protected $modelName = 'App\Models\UsuarioModel';
	protected $format = 'json';

	public function index(){
        

        $usuarios = $this->model->findAll();

        foreach ($usuarios as $key => $usuario) {
            
            $usuario->hiddenPassaword();
        
        }
        
		return $this->respond($usuarios);

	}

	public function show($id = null){
		
		$usuario = $this->model->find($id);

		if(!$usuario) {
			return $this->failNotFound('Item not found');
		}

		return $this->respond($usuario);
	}

	public function update($id = null){

        $usuario  = $this->model->find($id);

        if (!$usuario) {
			return $this->failNotFound('Item not found');
        }

        $usuario->setAdmin($this->request->getVar('admin'));
        $usuario->setPremium($this->request->getVar('premium'));
        $usuario->save();
		
		return $this->respond($usuario);
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

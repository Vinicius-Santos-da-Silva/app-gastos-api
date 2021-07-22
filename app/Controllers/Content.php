<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use \OAuth2\Request;

use \App\Libraries\Oauth;
use App\Models\ContentModel;

helper('form');

class Content extends BaseController
{
	use ResponseTrait;

	public function register(){

		$data = [];

		if($this->request->getMethod() != 'post') {
			return $this->fail('Only post request is allowed');
        }

		$rules = [
			'title' => 'required|min_length[3]|max_length[20]',
			'body' => 'required|min_length[0]',
		];

		if(! $this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}
			
        $model = new ContentModel();

        $data = [
            'title' => $this->request->getVar('title'),
            'body' => $this->request->getVar('body'),
        ];


        $user_id = $model->insert($data);
        $data['id'] = $user_id;
        unset($data['password']);

        return $this->respondCreated($data);
	}



}

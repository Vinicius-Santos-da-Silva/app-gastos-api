<?php 
namespace App\Helpers;

use App\Models\UsuarioModel;
use \App\Libraries\Oauth;
use \OAuth2\Request;
use \OAuth2\Response;

class User
{
    public static function getFromRequest() 
    {
        $request = new Request();
		$oauth = new Oauth();

		if (!$oauth->server->verifyResourceRequest($request->createFromGlobals())) {
			$oauth->server->getResponse()->send();
			die;
		}
		
        
        
		$token = $oauth->server->getAccessTokenData($request->createFromGlobals());
		
        $usuario_model = new UsuarioModel();
		
        $usuario = $usuario_model->find($token['user_id']);

        if (!$usuario) {
            throw new \Exception("Usuário não autorizado!", 1);
        }

        return $usuario;
    }
}

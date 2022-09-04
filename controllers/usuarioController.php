<?php

namespace controllers;

use app\base\Controller;
use Symfony\Component\HttpFoundation\Response;

class usuarioController extends Controller {

    public function indexAction()
    {
        if($this->isGet()) echo 'es un methodo get';

        //echo 'aqui esta funcionando el controlador de usuario';
        $request = $this->getRequest();
        $nombre = $this->getRequest()->query->get('username');
        echo $nombre;
    }

    public function infoAction(int $id){
        if(!$this->isGet()) $this->failReponse(Response::HTTP_FORBIDDEN);
        if(empty($id)) $this->failReponse(Response::HTTP_BAD_REQUEST);

        $partialView= $this->getRequest()->query->get('content');
        $otroparametro = $this->getRequest()->query->get('otroparametro');

        $data=[
            'id'=>$id,
            'otroparametro'=>$otroparametro
        ];

        if($partialView=='full'){
            $data=[
                'id'=>$id,
                'otroparametro'=>$otroparametro,
                'usuario'=> 'mcantu',
                'email'=>'mcantu@server.com',
                'phone'=>'222-33-44-5',
                'active'=>true,
                'isAdmin'=>true
            ];  
        }

        if($partialView=='medium'){
            $data=[
                'id'=>$id,
                'otroparametro'=>$otroparametro,
                'usuario'=> 'mcantu',
                'email'=>'mcantu@server.com'
            ];  
        }

        if($partialView=='low'){
            $data=[
                'id'=>$id,
                'otroparametro'=>$otroparametro,
                'usuario'=> 'mcantu'
            ];  
        }

        $this->OKResponse($data);

    }

    public function loginAction(){
        if(!$this->isPost()) $this->failReponse(Response::HTTP_FORBIDDEN);
        $usuario = $this->getRequest()->request->get('usuario');
        $password = $this->getRequest()->request->get('password');
        if(empty($usuario) || empty($password)) $this->failReponse(Response::HTTP_BAD_REQUEST);

        $this->OKResponse();
    }

    public function addAction(){

        if($this->isGet()) $this->redirect("/usuario");

        if(!$this->isPost()) {
           $this->failReponse(Response::HTTP_FORBIDDEN);
        }

        $content = $this->getRequest()->getContent();

        $data= [
            'success'=> true,
            'data' => 'todo ok',
            'content' => json_decode($content,true)
        ]; 

        $this->OKResponse($data);
    }

}
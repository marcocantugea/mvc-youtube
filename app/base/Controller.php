<?php 

namespace app\base;

use app\Interfaces\IController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class Controller implements IController {

    private $request;

    public function indexAction()
    {
        
    }

    public function failReponse(int $httpCodeResponse=400){
        $response = new Response();
        $response->setStatusCode($httpCodeResponse);
        $response->prepare($this->getRequest());
        $response->send();
        exit();
    }

    public function OKResponse(array $data=[]){
        $response = new Response();
        $response->setStatusCode(Response::HTTP_OK);
        if(empty($data)){
            $response->setStatusCode(Response::HTTP_NO_CONTENT);
        }else{
            $response->headers->set('Content-Type','application/json');
            $response->setContent(json_encode($data));
        }
        $response->prepare($this->getRequest());
        $response->send();
        exit();        
    }

    public function redirect(string $url){
        if(empty($url)) return;
        $response = new RedirectResponse($url);
        $response->send();
        exit();
    }

    public function getRequest(){
        if(empty($this->request)) $this->request=Request::createFromGlobals();
        return $this->request;
    }

    public function isGet(){
        return $this->getRequest()->server->get('REQUEST_METHOD')=='GET';
    }

    public function isPost(){
        return $this->getRequest()->server->get('REQUEST_METHOD')=='POST';
    }

    public function isPut(){
        return $this->getRequest()->server->get('REQUEST_METHOD')=='PUT';
    }

    public function isDelete(){
        return $this->getRequest()->server->get('REQUEST_METHOD')=='DELETE';
    }
}
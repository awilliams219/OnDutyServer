<?php


namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;


abstract class ApiController extends Controller {




    abstract public function listAction();
    abstract public function readAction($id);
    abstract public function createAction();
    abstract public function updateAction($id);
    abstract public function deleteAction($id);



    final protected function accessDenied() {
        return new JsonResponse([
                "status" => "err",
                "message" => "Access Denied"
            ],
            403
        );
    }




}
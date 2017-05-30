<?php


namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


abstract class ApiController extends Controller {

    abstract public function listAction();
    abstract public function readAction($id);
    abstract public function createAction(Request $request);
    abstract public function updateAction(Request $request,$id);
    abstract public function deleteAction($id);

    /**
     * @param int $code
     * @param string $message
     * @param array $payload
     * @return JsonResponse
     */
    protected function jsonResponse(int $code, string $message, array $payload): JsonResponse {
        return new JsonResponse([
            "status"  => ($code==Response::HTTP_OK || $code==Response::HTTP_CREATED) ? "ok" : "err",
            "message" => $message,
            "payload" => $payload
        ], $code);
    }

    final protected function accessDenied() {
        return new JsonResponse([
                "status" => "err",
                "message" => "Access Denied"
            ],
            403
        );
    }




}
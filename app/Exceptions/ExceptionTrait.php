<?php

namespace App\Exceptions;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ExceptionTrait
{
    public function apiException($request,$e)
    {
        if ($this->isModel($e)) {
            return $this->ModelResponse($e);
        }

        if ($this->isHttp($e)) {
            return $this->HttpResponse($e);
        }

        return parent::render($request, $e);

    }

    private function isModel($e){
        return $e instanceof ModelNotFoundException;
    }

    private function isHttp($e){
        return $e instanceof NotFoundHttpException;
    }

    private function ModelResponse($e){
        return response()->json([
            'error' => 'Model Not Found'
        ],404);
    }

    private function HttpResponse($e){
        return response()->json([
            'error' => 'Incorect uri'
        ],404);
    }
}
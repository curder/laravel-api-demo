<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ExceptionTrait
 */
trait ExceptionTrait
{
    /**
     * @return mixed
     */
    public function apiException($request, $e)
    {
        if ($this->isModelNotFound($e)) {
            return $this->modelResponse();
        }
        if ($this->isHttpNotFound($e)) {
            return $this->httpResponse();
        }

        return parent::render($request, $e);
    }

    /**
     * @return mixed
     */
    protected function modelResponse()
    {
        return response()->json([
            'errors' => 'Model Not Found',
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * @return mixed
     */
    protected function httpResponse()
    {
        return response()->json([
            'errors' => 'Incorrect route',
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * @return bool
     */
    protected function isModelNotFound($e)
    {
        return $e instanceof ModelNotFoundException;
    }

    /**
     * @return bool
     */
    protected function isHttpNotFound($e)
    {
        return $e instanceof NotFoundHttpException;
    }
}

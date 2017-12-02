<?php
namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ExceptionTrait
 * @package App\Exceptions
 */
trait ExceptionTrait
{
    /**
     * @param $request
     * @param $exception
     * @return mixed
     */
    public function apiException($request, $exception)
    {
        if ($this->isModelNotFound($exception)) {
            return $this->modelResponse();
        }
        if ($this->isHttpNotFound($exception)) {
            return $this->httpResponse();
        }
        return parent::render($request, $exception);
    }

    /**
     * @return mixed
     */
    protected function modelResponse()
    {
        return response()->json([
            'errors' => 'Model Not Found'
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * @return mixed
     */
    protected function httpResponse()
    {
        return response()->json([
            'errors' => 'Incorrect route'
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * @param $e
     * @return bool
     */
    protected function isModelNotFound($e)
    {
        return $e instanceof ModelNotFoundException;
    }

    /**
     * @param $e
     * @return bool
     */
    protected function isHttpNotFound($e)
    {
        return $e instanceof NotFoundHttpException;
    }
}

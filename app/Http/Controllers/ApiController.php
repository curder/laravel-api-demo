<?php

namespace App\Http\Controllers;

use Response;
use Illuminate\Contracts\Pagination\Paginator;

/**
 * Class APiController
 */
class ApiController extends Controller
{
    const HTTP_NOT_FOUND = 404;

    const HTTP_INTERNAL_SERVER_ERROR = 500;

    /**
     * @var int
     */
    protected $statusCode = 200;

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return  \App\Http\Controllers\ApiController
     */
    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param  string  $message
     * @return mixed
     */
    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(self::HTTP_NOT_FOUND)->respondWithError($message);
    }

    /**
     * @param  string  $message
     * @return mixed
     */
    public function respondInternalError($message = 'Internal Error!')
    {
        return $this->setStatusCode(self::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
    }

    /**
     * @param  array  $header
     * @return mixed
     */
    public function respond($data, $header = [])
    {
        return Response::json($data, $this->getStatusCode(), $header);
    }

    /**
     * @param  array  $data
     * @return mixed
     */
    protected function respondWithPagination(Paginator $items, $data)
    {
        $data = array_merge($data, [
            'paginator' => [
                'total_count' => $items->total(),
                'total_page' => $items->total() / $items->perPage(),
                'current_page' => $items->currentPage(),
                'limit' => (int) $items->perPage(),
            ],
        ]);

        return $this->respond($data);
    }

    /**
     * @return mixed
     */
    protected function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode(),
            ],
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Pagination\Paginator;

/**
 * Class APiController
 */
class ApiController extends Controller
{
    const HTTP_NOT_FOUND = 404;

    const HTTP_INTERNAL_SERVER_ERROR = 500;

    protected int $statusCode = 200;

    public function respondNotFound(string $message = 'Not Found!'): JsonResponse
    {
        return $this->setStatusCode(self::HTTP_NOT_FOUND)->respondWithError($message);
    }

    protected function respondWithError($message): JsonResponse
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode(),
            ],
        ]);
    }

    public function respond($data, array $header = []): JsonResponse
    {
        return Response::json($data, $this->getStatusCode(), $header);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function respondInternalError(string $message = 'Internal Error!')
    {
        return $this->setStatusCode(self::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
    }

    protected function respondWithPagination(Paginator $items, array $data): JsonResponse
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
}

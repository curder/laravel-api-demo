<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Pagination\Paginator;
use Response;

/**
 * Class APiController
 *
 * @package \App\Http\Controllers
 */
class ApiController extends Controller {
	const HTTP_NOT_FOUND = 404;
	const HTTP_INTERNAL_SERVER_ERROR = 500;
	/**
	 * @var int
	 */
	protected $statusCode = 200;

	/**
	 * @return int
	 */
	public function getStatusCode(): int {
		return $this->statusCode;
	}

	/**
	 * @param int $statusCode
	 *
	 * @return  \App\Http\Controllers\ApiController
	 */
	public function setStatusCode( int $statusCode ) {
		$this->statusCode = $statusCode;

		return $this;
	}

	/**
	 * @param string $message
	 *
	 * @return mixed
	 */
	public function respondNotFound( $message = 'Not Found!' ) {
		return $this->setStatusCode( self::HTTP_NOT_FOUND )->respondWithError( $message );
	}

	/**
	 * @param string $message
	 *
	 * @return mixed
	 */
	public function respondInternalError( $message = 'Internal Error!' ) {
		return $this->setStatusCode( self::HTTP_INTERNAL_SERVER_ERROR )->respondWithError( $message );
	}

	/**
	 * @param       $data
	 * @param array $header
	 *
	 * @return mixed
	 */
	public function respond( $data, $header = [] ) {
		return Response::json( $data, $this->getStatusCode(), $header );
	}

	/**
	 * @param Paginator $items
	 *
	 * @param array     $data
	 *
	 * @return mixed
	 */
	protected function respondWithPagination( Paginator $items, $data ) {

		$data = array_merge( $data, [
			'paginator' => [
				'total_count'  => $items->total(),
				'total_page'   => $items->total() / $items->perPage(),
				'current_page' => $items->currentPage(),
				'limit'        => (integer) $items->perPage(),
			]
		] );

		return $this->respond( $data );
	}

	/**
	 * @param $message
	 *
	 * @return mixed
	 */
	protected function respondWithError( $message ) {
		return $this->respond( [
			'error' => [
				'message'     => $message,
				'status_code' => $this->getStatusCode(),
			]
		] );
	}
}

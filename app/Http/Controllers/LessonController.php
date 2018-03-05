<?php

namespace App\Http\Controllers;

use App\Lesson;
use \Response;
use Illuminate\Http\Request;

class LessonController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$lessons = Lesson::all();

		return Response::json( [
			'data' => $this->transformCollection( $lessons ),
		], 404 );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( $id ) {
		$lesson = Lesson::find( $id );

		if ( ! $lesson ) {
			return Response::json( [
				'error' => [
					'message' => 'Lesson dose not exists.',
				],
			], 404 );
		}

		return Response::json( [
			'date' => $this->transform( $lesson )
		], 200 );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int                      $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, $id ) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		//
	}

	private function transformCollection( $lessons ) {
		return array_map( [ $this, 'transform' ], $lessons->toArray() );
	}

	private function transform( $lesson ) {
		return [
			'title'    => $lesson['title'],
			'body'     => $lesson['body'],
			'active'   => (bool) $lesson['some_bool'],
			'show_url' => route( 'lessons.show', $lesson['id'] ),
		];
	}
}

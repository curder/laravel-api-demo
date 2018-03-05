<?php

namespace App\Http\Controllers;

use App\Http\Transformers\LessonTransformer;
use App\Lesson;
use \Response;
use Illuminate\Http\Request;

/**
 * Class LessonController
 *
 * @package App\Http\Controllers
 */
class LessonController extends Controller {
	/**
	 * @var \App\Http\Transformers\LessonTransformer
	 */
	protected $lessonTransformer;

	/**
	 * LessonController constructor.
	 *
	 * @param LessonTransformer $lessonTransformer
	 */
	public function __construct( LessonTransformer $lessonTransformer ) {
		$this->lessonTransformer = $lessonTransformer;
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$lessons = Lesson::all();

		return Response::json( [
			'data' => $this->lessonTransformer->transformCollection( $lessons->all() ),
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
			'date' => $this->lessonTransformer->transform( $lesson )
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
}

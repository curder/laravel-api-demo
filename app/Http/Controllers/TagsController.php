<?php

namespace App\Http\Controllers;

use App\Http\Transformers\TagTransformer;
use App\Lesson;
use App\Tag;
use Illuminate\Http\Request;

/**
 * Class TagsController
 *
 * @package App\Http\Controllers
 */
class TagsController extends ApiController {
	/**
	 * @var \App\Http\Transformers\TagTransformer
	 */
	protected $tagTransformer;

	/**
	 * TagsController constructor.
	 *
	 * @param $tagTransformer
	 */
	public function __construct( TagTransformer $tagTransformer ) {
		$this->tagTransformer = $tagTransformer;
	}

	/**
	 * @return mixed
	 */
	public function index( $LessonId = null ) {

		$tags = $this->getTags( $LessonId );

		return $this->respond( [
			'data' => $this->tagTransformer->transformCollection( $tags->all() ),
		] );

	}

	/**
	 * @param $id
	 */
	public function show( $id ) {

	}

	/**
	 * @param $LessonId
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	protected function getTags( $LessonId ) {
		return $LessonId ? Lesson::findOrFail( $LessonId )->tags : Tag::all();
	}
}

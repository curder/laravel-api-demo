<?php

namespace App\Http\Transformers;

/**
 * Class LessonTransformer
 *
 * @package \App\Http\Transformers
 */
class LessonTransformer extends Transformer {


	/**
	 * @param $lesson
	 *
	 * @return mixed
	 */
	public function transform( $lesson ) {
		return [
			'title'    => $lesson['title'],
			'body'     => $lesson['body'],
			'active'   => (bool) $lesson['some_bool'],
			'show_url' => route( 'lessons.show', $lesson['id'] ),
		];
	}
}

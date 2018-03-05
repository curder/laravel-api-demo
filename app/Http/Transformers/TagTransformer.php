<?php

namespace App\Http\Transformers;

/**
 * Class TagTransformer
 *
 * @package \App\Http\Transformers
 */
class TagTransformer extends Transformer {

	/**
	 * @param $item
	 *
	 * @return mixed
	 */
	public function transform( $item ) {
		return [
			'name' => $item['name'],
		];
	}
}

<?php

namespace App\Http\Transformers;

/**
 * Class Transformer
 *
 * @package \App\Http\Transformers
 */
/**
 * Class Transformer
 *
 * @package App\Http\Transformers
 */
abstract class Transformer {
	/**
	 * @param $items
	 *
	 * @return array
	 */
	public function transformCollection( array $items ) {
		return array_map( [ $this, 'transform' ], $items );
	}

	/**
	 * @param $item
	 *
	 * @return mixed
	 */
	public abstract function transform( $item );
}

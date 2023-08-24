<?php

namespace App\Http\Transformers;

/**
 * Class Transformer
 */
/**
 * Class Transformer
 */
abstract class Transformer
{
    /**
     * @return array
     */
    public function transformCollection(array $items)
    {
        return array_map([$this, 'transform'], $items);
    }

    /**
     * @return mixed
     */
    abstract public function transform($item);
}

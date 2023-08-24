<?php

namespace App\Http\Transformers;

/**
 * Class TagTransformer
 */
class TagTransformer extends Transformer
{
    /**
     * @return mixed
     */
    public function transform($item)
    {
        return [
            'name' => $item['name'],
        ];
    }
}

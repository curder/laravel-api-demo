<?php

namespace App\Exceptions;

use Exception;

class ProductNotBelongsToUserException extends Exception
{
    /**
     * @return array
     */
    public function render()
    {
        return [
            'errors' => 'product not belongs to user.',
        ];
    }
}

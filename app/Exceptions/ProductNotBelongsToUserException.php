<?php

namespace App\Exceptions;

use Exception;

class ProductNotBelongsToUserException extends Exception
{
    public function render(): array
    {
        return [
            'errors' => 'product not belongs to user.',
        ];
    }
}

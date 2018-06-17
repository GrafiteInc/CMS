<?php

namespace Grafite\Cms\Exceptions;

use Exception;
use Grafite\Cms\Models\CmsModel;

class InvalidConfiguration extends Exception
{
    public static function modelIsNotValid(string $className)
    {
        return new static("The given model class `$className` does not extend `".CmsModel::class.'`');
    }
}

<?php

namespace Grafite\Cms\Forms\Fields;

use Grafite\FormMaker\Fields\Field;

class Tags extends Field
{
    protected static function getType()
    {
        return 'text';
    }

    protected static function getAttributes()
    {
        return [
            'class' => 'form-control tags'
        ];
    }
}

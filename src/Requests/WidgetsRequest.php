<?php

namespace Grafite\Quarx\Requests;

use Auth;
use Gate;
use Grafite\Quarx\Models\Widget;
use Illuminate\Foundation\Http\FormRequest;

class WidgetsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (config('app.env') !== 'testing') {
            return Gate::allows('quarx', Auth::user());
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Widget::$rules;
    }
}

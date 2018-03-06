<?php

namespace Yab\Cabin\Requests;

use Auth;
use Gate;
use Yab\Cabin\Models\Widget;
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
            return Gate::allows('cabin', Auth::user());
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

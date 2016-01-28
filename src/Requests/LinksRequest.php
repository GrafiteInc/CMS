<?php

namespace Yab\Quarx\Requests;

use Yab\Quarx\Models\Links;
use Illuminate\Foundation\Http\FormRequest;

class LinksRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Links::$rules;
    }

}

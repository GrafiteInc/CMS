<?php

namespace Yab\Quarx\Requests;

use Yab\Quarx\Models\FAQ;
use Illuminate\Foundation\Http\FormRequest;

class FAQRequest extends FormRequest
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
        return FAQ::$rules;
    }

}

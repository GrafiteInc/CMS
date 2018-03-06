<?php

namespace Yab\Cabin\Requests;

use Auth;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Yab\Cabin\Models\Blog;

class BlogRequest extends FormRequest
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
        return Blog::$rules;
    }
}

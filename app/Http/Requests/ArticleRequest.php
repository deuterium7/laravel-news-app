<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticleRequest extends FormRequest
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];

            case 'POST':
                return [
                    'title'  => 'required|max:255|unique:articles',
                    'image'  => 'required',
                    'body'   => 'required|min:100',
                ];

            case 'PUT':
            case 'PATCH':
                $id = $this->route('article');

                return [
                    'title'  => 'required|max:255|'.Rule::unique('articles')->ignore($id),
                    'image'  => '',
                    'body'   => 'required|min:100',
                ];

            default:
                break;
        }
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
                    'name'   => 'required|max:255|unique:categories',
                    'image'  => 'required|mimes:jpeg,png,jpg|dimensions:max_width=150,max_height=150',
                ];

            case 'PUT':
            case 'PATCH':
                $id = $this->route('category');

                return [
                    'name'   => 'required|max:255|'.Rule::unique('categories')->ignore($id),
                    'image'  => 'mimes:jpeg,png,jpg|dimensions:max_width=150,max_height=150',
                ];

            default:
                break;
        }
    }
}

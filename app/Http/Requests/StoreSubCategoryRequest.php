<?php

namespace App\Http\Requests;

use App\Models\SubCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSubCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sub_category_create');
    }

    public function rules()
    {
        return [
            'subcategory_img.*'  => [
                'required',
            ],
            'subcategory_code'   => [
                'string',
                'required',
                'unique:sub_categories',
            ],
            'subcategory_name'   => [
                'string',
                'required',
            ],
            'cat_id'             => [
                'required',
                'integer',
            ],
            'subcategory_status' => [
                'required',
            ],
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Models\SubCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSubCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sub_category_edit');
    }

    public function rules()
    {
        return [
            'subcategory_code'   => [
                'string',
                'required',
                'unique:sub_categories,subcategory_code,' . request()->route('sub_category')->id,
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

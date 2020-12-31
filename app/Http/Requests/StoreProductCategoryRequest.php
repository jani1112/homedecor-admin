<?php

namespace App\Http\Requests;

use App\Models\ProductCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_category_create');
    }

    public function rules()
    {
        return [
            'category_img.*'  => [
                'required',
            ],
            'category_code'   => [
                'string',
                'required',
                'unique:product_categories',
            ],
            'category_name'   => [
                'string',
                'required',
            ],
            'category_status' => [
                'required',
            ],
        ];
    }
}

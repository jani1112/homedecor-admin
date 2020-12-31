<?php

namespace App\Http\Requests;

use App\Models\FeaturedProduct;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFeaturedProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('featured_product_create');
    }

    public function rules()
    {
        return [
            'featured_product_id'     => [
                'required',
                'integer',
            ],
            'featured_product_status' => [
                'required',
            ],
        ];
    }
}

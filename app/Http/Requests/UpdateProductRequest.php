<?php

namespace App\Http\Requests;

use App\Models\Product;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_edit');
    }

    public function rules()
    {
        return [
            'catid_id'       => [
                'required',
                'integer',
            ],
            'subcatid_id'    => [
                'required',
                'integer',
            ],
            'product_name'   => [
                'string',
                'required',
            ],
            'stock'          => [
                'required',
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'price'          => [
                'required',
            ],
            'final_price'    => [
                'required',
            ],
            'hsn_code'       => [
                'string',
                'nullable',
            ],
            'product_status' => [
                'required',
            ],
        ];
    }
}

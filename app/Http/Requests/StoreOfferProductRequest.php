<?php

namespace App\Http\Requests;

use App\Models\OfferProduct;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOfferProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('offer_product_create');
    }

    public function rules()
    {
        return [
            'offer_product_id'     => [
                'required',
                'integer',
            ],
            'offer_product_status' => [
                'required',
            ],
        ];
    }
}

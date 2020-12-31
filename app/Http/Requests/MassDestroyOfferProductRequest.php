<?php

namespace App\Http\Requests;

use App\Models\OfferProduct;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyOfferProductRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('offer_product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:offer_products,id',
        ];
    }
}

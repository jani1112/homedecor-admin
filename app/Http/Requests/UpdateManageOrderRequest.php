<?php

namespace App\Http\Requests;

use App\Models\ManageOrder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateManageOrderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('manage_order_edit');
    }

    public function rules()
    {
        return [
            'bill_no'       => [
                'string',
                'required',
            ],
            'customerid'    => [
                'string',
                'required',
            ],
            'total_amount'  => [
                'required',
            ],
            'order_status'  => [
                'required',
            ],
            'total_product' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'payment_type'  => [
                'required',
            ],
        ];
    }
}

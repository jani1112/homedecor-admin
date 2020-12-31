<?php

namespace App\Http\Requests;

use App\Models\ManagerCoupon;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreManagerCouponRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('manager_coupon_create');
    }

    public function rules()
    {
        return [
            'coupon_code'   => [
                'string',
                'required',
                'unique:manager_coupons',
            ],
            'coupon_value'  => [
                'required',
            ],
            'coupon_status' => [
                'required',
            ],
        ];
    }
}

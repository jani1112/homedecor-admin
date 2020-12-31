<?php

namespace App\Http\Requests;

use App\Models\ManagerCoupon;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyManagerCouponRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('manager_coupon_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:manager_coupons,id',
        ];
    }
}

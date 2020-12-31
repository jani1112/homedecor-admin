<?php

namespace App\Http\Requests;

use App\Models\ManageOrder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyManageOrderRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('manage_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:manage_orders,id',
        ];
    }
}

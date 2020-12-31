<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreManagerCouponRequest;
use App\Http\Requests\UpdateManagerCouponRequest;
use App\Http\Resources\Admin\ManagerCouponResource;
use App\Models\ManagerCoupon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManagerCouponsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('manager_coupon_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ManagerCouponResource(ManagerCoupon::all());
    }

    public function store(StoreManagerCouponRequest $request)
    {
        $managerCoupon = ManagerCoupon::create($request->all());

        return (new ManagerCouponResource($managerCoupon))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ManagerCoupon $managerCoupon)
    {
        abort_if(Gate::denies('manager_coupon_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ManagerCouponResource($managerCoupon);
    }

    public function update(UpdateManagerCouponRequest $request, ManagerCoupon $managerCoupon)
    {
        $managerCoupon->update($request->all());

        return (new ManagerCouponResource($managerCoupon))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ManagerCoupon $managerCoupon)
    {
        abort_if(Gate::denies('manager_coupon_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $managerCoupon->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

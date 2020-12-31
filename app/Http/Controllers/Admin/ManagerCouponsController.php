<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyManagerCouponRequest;
use App\Http\Requests\StoreManagerCouponRequest;
use App\Http\Requests\UpdateManagerCouponRequest;
use App\Models\ManagerCoupon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManagerCouponsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('manager_coupon_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $managerCoupons = ManagerCoupon::all();

        return view('admin.managerCoupons.index', compact('managerCoupons'));
    }

    public function create()
    {
        abort_if(Gate::denies('manager_coupon_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.managerCoupons.create');
    }

    public function store(StoreManagerCouponRequest $request)
    {
        $managerCoupon = ManagerCoupon::create($request->all());

        return redirect()->route('admin.manager-coupons.index');
    }

    public function edit(ManagerCoupon $managerCoupon)
    {
        abort_if(Gate::denies('manager_coupon_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.managerCoupons.edit', compact('managerCoupon'));
    }

    public function update(UpdateManagerCouponRequest $request, ManagerCoupon $managerCoupon)
    {
        $managerCoupon->update($request->all());

        return redirect()->route('admin.manager-coupons.index');
    }

    public function show(ManagerCoupon $managerCoupon)
    {
        abort_if(Gate::denies('manager_coupon_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.managerCoupons.show', compact('managerCoupon'));
    }

    public function destroy(ManagerCoupon $managerCoupon)
    {
        abort_if(Gate::denies('manager_coupon_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $managerCoupon->delete();

        return back();
    }

    public function massDestroy(MassDestroyManagerCouponRequest $request)
    {
        ManagerCoupon::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

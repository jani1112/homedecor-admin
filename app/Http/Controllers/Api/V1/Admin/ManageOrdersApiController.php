<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreManageOrderRequest;
use App\Http\Requests\UpdateManageOrderRequest;
use App\Http\Resources\Admin\ManageOrderResource;
use App\Models\ManageOrder;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManageOrdersApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('manage_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ManageOrderResource(ManageOrder::all());
    }

    public function store(StoreManageOrderRequest $request)
    {
        $manageOrder = ManageOrder::create($request->all());

        return (new ManageOrderResource($manageOrder))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ManageOrder $manageOrder)
    {
        abort_if(Gate::denies('manage_order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ManageOrderResource($manageOrder);
    }

    public function update(UpdateManageOrderRequest $request, ManageOrder $manageOrder)
    {
        $manageOrder->update($request->all());

        return (new ManageOrderResource($manageOrder))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ManageOrder $manageOrder)
    {
        abort_if(Gate::denies('manage_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $manageOrder->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

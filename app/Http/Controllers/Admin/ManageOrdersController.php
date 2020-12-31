<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyManageOrderRequest;
use App\Http\Requests\StoreManageOrderRequest;
use App\Http\Requests\UpdateManageOrderRequest;
use App\Models\ManageOrder;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ManageOrdersController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('manage_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ManageOrder::query()->select(sprintf('%s.*', (new ManageOrder)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'manage_order_show';
                $editGate      = 'manage_order_edit';
                $deleteGate    = 'manage_order_delete';
                $crudRoutePart = 'manage-orders';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('bill_no', function ($row) {
                return $row->bill_no ? $row->bill_no : "";
            });
            $table->editColumn('customerid', function ($row) {
                return $row->customerid ? $row->customerid : "";
            });
            $table->editColumn('total_amount', function ($row) {
                return $row->total_amount ? $row->total_amount : "";
            });
            $table->editColumn('order_status', function ($row) {
                return $row->order_status ? ManageOrder::ORDER_STATUS_SELECT[$row->order_status] : '';
            });
            $table->editColumn('total_product', function ($row) {
                return $row->total_product ? $row->total_product : "";
            });
            $table->editColumn('payment_type', function ($row) {
                return $row->payment_type ? ManageOrder::PAYMENT_TYPE_SELECT[$row->payment_type] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.manageOrders.index');
    }

    public function create()
    {
        abort_if(Gate::denies('manage_order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.manageOrders.create');
    }

    public function store(StoreManageOrderRequest $request)
    {
        $manageOrder = ManageOrder::create($request->all());

        return redirect()->route('admin.manage-orders.index');
    }

    public function edit(ManageOrder $manageOrder)
    {
        abort_if(Gate::denies('manage_order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.manageOrders.edit', compact('manageOrder'));
    }

    public function update(UpdateManageOrderRequest $request, ManageOrder $manageOrder)
    {
        $manageOrder->update($request->all());

        return redirect()->route('admin.manage-orders.index');
    }

    public function show(ManageOrder $manageOrder)
    {
        abort_if(Gate::denies('manage_order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.manageOrders.show', compact('manageOrder'));
    }

    public function destroy(ManageOrder $manageOrder)
    {
        abort_if(Gate::denies('manage_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $manageOrder->delete();

        return back();
    }

    public function massDestroy(MassDestroyManageOrderRequest $request)
    {
        ManageOrder::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

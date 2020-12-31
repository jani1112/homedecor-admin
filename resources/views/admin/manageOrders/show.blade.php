@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.manageOrder.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.manage-orders.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.manageOrder.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $manageOrder->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.manageOrder.fields.bill_no') }}
                                    </th>
                                    <td>
                                        {{ $manageOrder->bill_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.manageOrder.fields.customerid') }}
                                    </th>
                                    <td>
                                        {{ $manageOrder->customerid }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.manageOrder.fields.total_amount') }}
                                    </th>
                                    <td>
                                        {{ $manageOrder->total_amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.manageOrder.fields.order_status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\ManageOrder::ORDER_STATUS_SELECT[$manageOrder->order_status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.manageOrder.fields.total_product') }}
                                    </th>
                                    <td>
                                        {{ $manageOrder->total_product }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.manageOrder.fields.payment_type') }}
                                    </th>
                                    <td>
                                        {{ App\Models\ManageOrder::PAYMENT_TYPE_SELECT[$manageOrder->payment_type] ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.manage-orders.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection
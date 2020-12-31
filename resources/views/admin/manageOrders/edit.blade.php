@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.manageOrder.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.manage-orders.update", [$manageOrder->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('bill_no') ? 'has-error' : '' }}">
                            <label class="required" for="bill_no">{{ trans('cruds.manageOrder.fields.bill_no') }}</label>
                            <input class="form-control" type="text" name="bill_no" id="bill_no" value="{{ old('bill_no', $manageOrder->bill_no) }}" required>
                            @if($errors->has('bill_no'))
                                <span class="help-block" role="alert">{{ $errors->first('bill_no') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.manageOrder.fields.bill_no_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('customerid') ? 'has-error' : '' }}">
                            <label class="required" for="customerid">{{ trans('cruds.manageOrder.fields.customerid') }}</label>
                            <input class="form-control" type="text" name="customerid" id="customerid" value="{{ old('customerid', $manageOrder->customerid) }}" required>
                            @if($errors->has('customerid'))
                                <span class="help-block" role="alert">{{ $errors->first('customerid') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.manageOrder.fields.customerid_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('total_amount') ? 'has-error' : '' }}">
                            <label class="required" for="total_amount">{{ trans('cruds.manageOrder.fields.total_amount') }}</label>
                            <input class="form-control" type="number" name="total_amount" id="total_amount" value="{{ old('total_amount', $manageOrder->total_amount) }}" step="0.01" required>
                            @if($errors->has('total_amount'))
                                <span class="help-block" role="alert">{{ $errors->first('total_amount') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.manageOrder.fields.total_amount_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('order_status') ? 'has-error' : '' }}">
                            <label class="required">{{ trans('cruds.manageOrder.fields.order_status') }}</label>
                            <select class="form-control" name="order_status" id="order_status" required>
                                <option value disabled {{ old('order_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\ManageOrder::ORDER_STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('order_status', $manageOrder->order_status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('order_status'))
                                <span class="help-block" role="alert">{{ $errors->first('order_status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.manageOrder.fields.order_status_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('total_product') ? 'has-error' : '' }}">
                            <label class="required" for="total_product">{{ trans('cruds.manageOrder.fields.total_product') }}</label>
                            <input class="form-control" type="number" name="total_product" id="total_product" value="{{ old('total_product', $manageOrder->total_product) }}" step="1" required>
                            @if($errors->has('total_product'))
                                <span class="help-block" role="alert">{{ $errors->first('total_product') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.manageOrder.fields.total_product_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('payment_type') ? 'has-error' : '' }}">
                            <label class="required">{{ trans('cruds.manageOrder.fields.payment_type') }}</label>
                            <select class="form-control" name="payment_type" id="payment_type" required>
                                <option value disabled {{ old('payment_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\ManageOrder::PAYMENT_TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('payment_type', $manageOrder->payment_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('payment_type'))
                                <span class="help-block" role="alert">{{ $errors->first('payment_type') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.manageOrder.fields.payment_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection
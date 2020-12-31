@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.managerCoupon.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.manager-coupons.update", [$managerCoupon->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('coupon_code') ? 'has-error' : '' }}">
                            <label class="required" for="coupon_code">{{ trans('cruds.managerCoupon.fields.coupon_code') }}</label>
                            <input class="form-control" type="text" name="coupon_code" id="coupon_code" value="{{ old('coupon_code', $managerCoupon->coupon_code) }}" required>
                            @if($errors->has('coupon_code'))
                                <span class="help-block" role="alert">{{ $errors->first('coupon_code') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.managerCoupon.fields.coupon_code_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('coupon_value') ? 'has-error' : '' }}">
                            <label class="required" for="coupon_value">{{ trans('cruds.managerCoupon.fields.coupon_value') }}</label>
                            <input class="form-control" type="number" name="coupon_value" id="coupon_value" value="{{ old('coupon_value', $managerCoupon->coupon_value) }}" step="0.01" required>
                            @if($errors->has('coupon_value'))
                                <span class="help-block" role="alert">{{ $errors->first('coupon_value') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.managerCoupon.fields.coupon_value_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('coupon_status') ? 'has-error' : '' }}">
                            <label class="required">{{ trans('cruds.managerCoupon.fields.coupon_status') }}</label>
                            <select class="form-control" name="coupon_status" id="coupon_status" required>
                                <option value disabled {{ old('coupon_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\ManagerCoupon::COUPON_STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('coupon_status', $managerCoupon->coupon_status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('coupon_status'))
                                <span class="help-block" role="alert">{{ $errors->first('coupon_status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.managerCoupon.fields.coupon_status_helper') }}</span>
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
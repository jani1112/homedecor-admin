@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.offerProduct.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.offer-products.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('offer_product') ? 'has-error' : '' }}">
                            <label class="required" for="offer_product_id">{{ trans('cruds.offerProduct.fields.offer_product') }}</label>
                            <select class="form-control select2" name="offer_product_id" id="offer_product_id" required>
                                @foreach($offer_products as $id => $offer_product)
                                    <option value="{{ $id }}" {{ old('offer_product_id') == $id ? 'selected' : '' }}>{{ $offer_product }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('offer_product'))
                                <span class="help-block" role="alert">{{ $errors->first('offer_product') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.offerProduct.fields.offer_product_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('offer_product_status') ? 'has-error' : '' }}">
                            <label class="required">{{ trans('cruds.offerProduct.fields.offer_product_status') }}</label>
                            <select class="form-control" name="offer_product_status" id="offer_product_status" required>
                                <option value disabled {{ old('offer_product_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\OfferProduct::OFFER_PRODUCT_STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('offer_product_status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('offer_product_status'))
                                <span class="help-block" role="alert">{{ $errors->first('offer_product_status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.offerProduct.fields.offer_product_status_helper') }}</span>
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
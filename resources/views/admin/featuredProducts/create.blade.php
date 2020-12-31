@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.featuredProduct.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.featured-products.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('featured_product') ? 'has-error' : '' }}">
                            <label class="required" for="featured_product_id">{{ trans('cruds.featuredProduct.fields.featured_product') }}</label>
                            <select class="form-control select2" name="featured_product_id" id="featured_product_id" required>
                                @foreach($featured_products as $id => $featured_product)
                                    <option value="{{ $id }}" {{ old('featured_product_id') == $id ? 'selected' : '' }}>{{ $featured_product }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('featured_product'))
                                <span class="help-block" role="alert">{{ $errors->first('featured_product') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.featuredProduct.fields.featured_product_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('featured_product_status') ? 'has-error' : '' }}">
                            <label class="required">{{ trans('cruds.featuredProduct.fields.featured_product_status') }}</label>
                            <select class="form-control" name="featured_product_status" id="featured_product_status" required>
                                <option value disabled {{ old('featured_product_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\FeaturedProduct::FEATURED_PRODUCT_STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('featured_product_status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('featured_product_status'))
                                <span class="help-block" role="alert">{{ $errors->first('featured_product_status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.featuredProduct.fields.featured_product_status_helper') }}</span>
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
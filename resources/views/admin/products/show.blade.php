@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.product.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.products.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $product->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.product_img') }}
                                    </th>
                                    <td>
                                        @foreach($product->product_img as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $media->getUrl('thumb') }}">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.catid') }}
                                    </th>
                                    <td>
                                        {{ $product->catid->category_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.subcatid') }}
                                    </th>
                                    <td>
                                        {{ $product->subcatid->subcategory_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.product_name') }}
                                    </th>
                                    <td>
                                        {{ $product->product_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.stock') }}
                                    </th>
                                    <td>
                                        {{ $product->stock }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $product->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.price') }}
                                    </th>
                                    <td>
                                        {{ $product->price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.gst') }}
                                    </th>
                                    <td>
                                        {{ $product->gst }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.final_price') }}
                                    </th>
                                    <td>
                                        {{ $product->final_price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.hsn_code') }}
                                    </th>
                                    <td>
                                        {{ $product->hsn_code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.offer_price') }}
                                    </th>
                                    <td>
                                        {{ $product->offer_price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.product_status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Product::PRODUCT_STATUS_SELECT[$product->product_status] ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.products.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.relatedData') }}
                </div>
                <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                    <li role="presentation">
                        <a href="#featured_product_featured_products" aria-controls="featured_product_featured_products" role="tab" data-toggle="tab">
                            {{ trans('cruds.featuredProduct.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#offer_product_offer_products" aria-controls="offer_product_offer_products" role="tab" data-toggle="tab">
                            {{ trans('cruds.offerProduct.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="featured_product_featured_products">
                        @includeIf('admin.products.relationships.featuredProductFeaturedProducts', ['featuredProducts' => $product->featuredProductFeaturedProducts])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="offer_product_offer_products">
                        @includeIf('admin.products.relationships.offerProductOfferProducts', ['offerProducts' => $product->offerProductOfferProducts])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
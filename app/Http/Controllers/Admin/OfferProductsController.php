<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOfferProductRequest;
use App\Http\Requests\StoreOfferProductRequest;
use App\Http\Requests\UpdateOfferProductRequest;
use App\Models\OfferProduct;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OfferProductsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('offer_product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $offerProducts = OfferProduct::with(['offer_product'])->get();

        return view('admin.offerProducts.index', compact('offerProducts'));
    }

    public function create()
    {
        abort_if(Gate::denies('offer_product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $offer_products = Product::all()->pluck('product_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.offerProducts.create', compact('offer_products'));
    }

    public function store(StoreOfferProductRequest $request)
    {
        $offerProduct = OfferProduct::create($request->all());

        return redirect()->route('admin.offer-products.index');
    }

    public function edit(OfferProduct $offerProduct)
    {
        abort_if(Gate::denies('offer_product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $offer_products = Product::all()->pluck('product_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $offerProduct->load('offer_product');

        return view('admin.offerProducts.edit', compact('offer_products', 'offerProduct'));
    }

    public function update(UpdateOfferProductRequest $request, OfferProduct $offerProduct)
    {
        $offerProduct->update($request->all());

        return redirect()->route('admin.offer-products.index');
    }

    public function show(OfferProduct $offerProduct)
    {
        abort_if(Gate::denies('offer_product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $offerProduct->load('offer_product');

        return view('admin.offerProducts.show', compact('offerProduct'));
    }

    public function destroy(OfferProduct $offerProduct)
    {
        abort_if(Gate::denies('offer_product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $offerProduct->delete();

        return back();
    }

    public function massDestroy(MassDestroyOfferProductRequest $request)
    {
        OfferProduct::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOfferProductRequest;
use App\Http\Requests\UpdateOfferProductRequest;
use App\Http\Resources\Admin\OfferProductResource;
use App\Models\OfferProduct;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OfferProductsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('offer_product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OfferProductResource(OfferProduct::with(['offer_product'])->get());
    }

    public function store(StoreOfferProductRequest $request)
    {
        $offerProduct = OfferProduct::create($request->all());

        return (new OfferProductResource($offerProduct))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(OfferProduct $offerProduct)
    {
        abort_if(Gate::denies('offer_product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OfferProductResource($offerProduct->load(['offer_product']));
    }

    public function update(UpdateOfferProductRequest $request, OfferProduct $offerProduct)
    {
        $offerProduct->update($request->all());

        return (new OfferProductResource($offerProduct))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(OfferProduct $offerProduct)
    {
        abort_if(Gate::denies('offer_product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $offerProduct->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

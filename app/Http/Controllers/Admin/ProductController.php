<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\SubCategory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Product::with(['catid', 'subcatid'])->select(sprintf('%s.*', (new Product)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'product_show';
                $editGate      = 'product_edit';
                $deleteGate    = 'product_delete';
                $crudRoutePart = 'products';

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
            $table->editColumn('product_img', function ($row) {
                if (!$row->product_img) {
                    return '';
                }

                $links = [];

                foreach ($row->product_img as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            $table->addColumn('catid_category_name', function ($row) {
                return $row->catid ? $row->catid->category_name : '';
            });

            $table->editColumn('catid.category_code', function ($row) {
                return $row->catid ? (is_string($row->catid) ? $row->catid : $row->catid->category_code) : '';
            });
            $table->addColumn('subcatid_subcategory_name', function ($row) {
                return $row->subcatid ? $row->subcatid->subcategory_name : '';
            });

            $table->editColumn('subcatid.subcategory_code', function ($row) {
                return $row->subcatid ? (is_string($row->subcatid) ? $row->subcatid : $row->subcatid->subcategory_code) : '';
            });
            $table->editColumn('product_name', function ($row) {
                return $row->product_name ? $row->product_name : "";
            });
            $table->editColumn('stock', function ($row) {
                return $row->stock ? $row->stock : "";
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : "";
            });
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : "";
            });
            $table->editColumn('gst', function ($row) {
                return $row->gst ? $row->gst : "";
            });
            $table->editColumn('final_price', function ($row) {
                return $row->final_price ? $row->final_price : "";
            });
            $table->editColumn('hsn_code', function ($row) {
                return $row->hsn_code ? $row->hsn_code : "";
            });
            $table->editColumn('offer_price', function ($row) {
                return $row->offer_price ? $row->offer_price : "";
            });
            $table->editColumn('product_status', function ($row) {
                return $row->product_status ? Product::PRODUCT_STATUS_SELECT[$row->product_status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'product_img', 'catid', 'subcatid']);

            return $table->make(true);
        }

        return view('admin.products.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $catids = ProductCategory::all()->pluck('category_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subcatids = SubCategory::all()->pluck('subcategory_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.products.create', compact('catids', 'subcatids'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());

        foreach ($request->input('product_img', []) as $file) {
            $product->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('product_img');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $product->id]);
        }

        return redirect()->route('admin.products.index');
    }

    public function edit(Product $product)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $catids = ProductCategory::all()->pluck('category_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subcatids = SubCategory::all()->pluck('subcategory_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product->load('catid', 'subcatid');

        return view('admin.products.edit', compact('catids', 'subcatids', 'product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());

        if (count($product->product_img) > 0) {
            foreach ($product->product_img as $media) {
                if (!in_array($media->file_name, $request->input('product_img', []))) {
                    $media->delete();
                }
            }
        }

        $media = $product->product_img->pluck('file_name')->toArray();

        foreach ($request->input('product_img', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $product->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('product_img');
            }
        }

        return redirect()->route('admin.products.index');
    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->load('catid', 'subcatid', 'featuredProductFeaturedProducts', 'offerProductOfferProducts');

        return view('admin.products.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductRequest $request)
    {
        Product::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_create') && Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Product();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

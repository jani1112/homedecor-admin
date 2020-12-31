<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySubCategoryRequest;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;
use App\Models\ProductCategory;
use App\Models\SubCategory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SubCategoriesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('sub_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SubCategory::with(['cat'])->select(sprintf('%s.*', (new SubCategory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'sub_category_show';
                $editGate      = 'sub_category_edit';
                $deleteGate    = 'sub_category_delete';
                $crudRoutePart = 'sub-categories';

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
            $table->editColumn('subcategory_img', function ($row) {
                if (!$row->subcategory_img) {
                    return '';
                }

                $links = [];

                foreach ($row->subcategory_img as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            $table->editColumn('subcategory_code', function ($row) {
                return $row->subcategory_code ? $row->subcategory_code : "";
            });
            $table->editColumn('subcategory_name', function ($row) {
                return $row->subcategory_name ? $row->subcategory_name : "";
            });
            $table->addColumn('cat_category_name', function ($row) {
                return $row->cat ? $row->cat->category_name : '';
            });

            $table->editColumn('cat.category_code', function ($row) {
                return $row->cat ? (is_string($row->cat) ? $row->cat : $row->cat->category_code) : '';
            });
            $table->editColumn('subcategory_status', function ($row) {
                return $row->subcategory_status ? SubCategory::SUBCATEGORY_STATUS_SELECT[$row->subcategory_status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'subcategory_img', 'cat']);

            return $table->make(true);
        }

        return view('admin.subCategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sub_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cats = ProductCategory::all()->pluck('category_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.subCategories.create', compact('cats'));
    }

    public function store(StoreSubCategoryRequest $request)
    {
        $subCategory = SubCategory::create($request->all());

        foreach ($request->input('subcategory_img', []) as $file) {
            $subCategory->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('subcategory_img');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $subCategory->id]);
        }

        return redirect()->route('admin.sub-categories.index');
    }

    public function edit(SubCategory $subCategory)
    {
        abort_if(Gate::denies('sub_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cats = ProductCategory::all()->pluck('category_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subCategory->load('cat');

        return view('admin.subCategories.edit', compact('cats', 'subCategory'));
    }

    public function update(UpdateSubCategoryRequest $request, SubCategory $subCategory)
    {
        $subCategory->update($request->all());

        if (count($subCategory->subcategory_img) > 0) {
            foreach ($subCategory->subcategory_img as $media) {
                if (!in_array($media->file_name, $request->input('subcategory_img', []))) {
                    $media->delete();
                }
            }
        }

        $media = $subCategory->subcategory_img->pluck('file_name')->toArray();

        foreach ($request->input('subcategory_img', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $subCategory->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('subcategory_img');
            }
        }

        return redirect()->route('admin.sub-categories.index');
    }

    public function show(SubCategory $subCategory)
    {
        abort_if(Gate::denies('sub_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subCategory->load('cat');

        return view('admin.subCategories.show', compact('subCategory'));
    }

    public function destroy(SubCategory $subCategory)
    {
        abort_if(Gate::denies('sub_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroySubCategoryRequest $request)
    {
        SubCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('sub_category_create') && Gate::denies('sub_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SubCategory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

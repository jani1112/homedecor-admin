<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFeedbackViewRequest;
use App\Models\FeedbackView;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FeedbackViewController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('feedback_view_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FeedbackView::with(['product'])->select(sprintf('%s.*', (new FeedbackView)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'feedback_view_show';
                $editGate      = 'feedback_view_edit';
                $deleteGate    = 'feedback_view_delete';
                $crudRoutePart = 'feedback-views';

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
            $table->editColumn('customerfeedback_email', function ($row) {
                return $row->customerfeedback_email ? $row->customerfeedback_email : "";
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : "";
            });
            $table->addColumn('product_product_name', function ($row) {
                return $row->product ? $row->product->product_name : '';
            });

            $table->editColumn('product.hsn_code', function ($row) {
                return $row->product ? (is_string($row->product) ? $row->product : $row->product->hsn_code) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'product']);

            return $table->make(true);
        }

        return view('admin.feedbackViews.index');
    }

    public function show(FeedbackView $feedbackView)
    {
        abort_if(Gate::denies('feedback_view_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feedbackView->load('product');

        return view('admin.feedbackViews.show', compact('feedbackView'));
    }

    public function destroy(FeedbackView $feedbackView)
    {
        abort_if(Gate::denies('feedback_view_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feedbackView->delete();

        return back();
    }

    public function massDestroy(MassDestroyFeedbackViewRequest $request)
    {
        FeedbackView::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

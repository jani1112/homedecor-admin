<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\FeedbackViewResource;
use App\Models\FeedbackView;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FeedbackViewApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('feedback_view_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FeedbackViewResource(FeedbackView::with(['product'])->get());
    }

    public function show(FeedbackView $feedbackView)
    {
        abort_if(Gate::denies('feedback_view_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FeedbackViewResource($feedbackView->load(['product']));
    }

    public function destroy(FeedbackView $feedbackView)
    {
        abort_if(Gate::denies('feedback_view_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feedbackView->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

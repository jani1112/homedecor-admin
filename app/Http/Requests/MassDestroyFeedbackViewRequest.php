<?php

namespace App\Http\Requests;

use App\Models\FeedbackView;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFeedbackViewRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('feedback_view_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:feedback_views,id',
        ];
    }
}

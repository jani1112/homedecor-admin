<?php

namespace App\Http\Requests;

use App\Models\FeedbackView;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFeedbackViewRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('feedback_view_edit');
    }

    public function rules()
    {
        return [];
    }
}

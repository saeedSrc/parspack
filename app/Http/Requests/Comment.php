<?php

namespace App\Http\Requests;

use App\Rules\CommentLimitter;
use App\Rules\IranianPhoneNumberValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class Comment extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'comment' => 'required|min:3|max:1000',
            'p_name' => ['required', 'string', new CommentLimitter()],
        ];
    }

}

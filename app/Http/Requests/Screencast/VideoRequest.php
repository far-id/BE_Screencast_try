<?php

namespace App\Http\Requests\Screencast;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'unique_video_id' => 'required',
            'episode' => 'required',
            'runtime' => 'required',
        ];
    }
}

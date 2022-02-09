<?php

namespace App\Http\Requests\Screencast;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;
use Illuminate\Validation\Rule;

class PlaylistRequest extends FormRequest
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
    public function rules(Route $route)
    {
        return [
            'thumbnail' => ['image', 'mimes:jpg,jpeg,png', Rule::requiredIf($route->getActionName() == "App\Http\Controllers\Screencast\PlaylistController@store")],
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
        ];
    }
}

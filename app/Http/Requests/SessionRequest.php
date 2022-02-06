<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class SessionRequest extends FormRequest
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
        return request()->isMethod('post') ? $this->store() :  $this->update();

    }

    public function store()
    {

        return [
            'name'=>'required|string',
            'duration'=>'integer|between:1,30',
            'start_at'=>'date|after_or_equal:'.Carbon::now()->toDateString(),
            'description'=>'sometimes:nullable|max:255'
        ];

    } //end of store function

    public function update()
    {


    } //end of update function


}

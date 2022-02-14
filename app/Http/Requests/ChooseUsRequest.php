<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChooseUsRequest extends FormRequest
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
                'choose_title_1'=>'required',
                'choose_title_2'=>'required',
                'choose_title_3'=>'required',
                'choose_title_4'=>'required',
                'title'=>'required',
                'sub_title'=>'required',
                'description'=>'required',
                'btn_title'=>'required',
                'vedio_link'=>'required',

        ];
    }
}

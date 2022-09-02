<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlanRequest extends FormRequest
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
     * @param mixed $id
     */
    public function rules()
    {
        // $test = $this->input();
        $rules = [
            'lender_id' => 'required|integer',
            'plan_name' => 'required|string|max:32',
            'plan_description' => 'nullable|string',
            'delay' => 'required|string',
            'price_includes' => 'nullable|string|max:32',
            'to_prepare' => 'nullable|string|max:32',
            'collection' => 'nullable|string|max:32',
            'return' => 'nullable|string|max:32',
            'reservation' => 'nullable|string|max:32',
            'other' => 'nullable|string',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'plan_name' => 'プラン名',
            'delay' => '時期',
        ];
    }
}

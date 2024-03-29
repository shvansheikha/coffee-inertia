<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBasketRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('update', $this->route('basket'));
    }

    public function rules(): array
    {
        return [
            'price' => ['sometimes', 'numeric', 'min:0', 'max:99999999'],
            'closed' => ['required', 'boolean'],
        ];
    }
}

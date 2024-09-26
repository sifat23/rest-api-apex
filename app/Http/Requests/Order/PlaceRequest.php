<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\Auth;

class PlaceRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'products' => [
                'required',
                'array',
                'present',
                'min:1',
                function ($attribute, $value, $fail) {
                    if (count($value) !== count(request('quantities'))) {
                        $fail('The products and quantities arrays must have the same number of items.');
                    }
                }
            ],
            'quantities' => 'required|array|present|min:1',
            'products.*' => 'required|distinct',
            'quantities.*' => 'required|numeric',
        ];
    }


    public function messages(): array
    {
        return [
            'products.*.required' => 'Product ID required',
            'quantities.*.required' => 'Quantity can not be empty'
        ];
    }
}

<?php

namespace App\Http\Requests\Product;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Packages\Domain\Models\Product\ProductName;

class ProductCreateFormRequest extends FormRequest
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
            'name' => [
                'required',
                sprintf('max:%s', ProductName::MAX_LENGTH),
                'string',
            ],
            'price' => [
                'required',
                'numeric'
            ],
            'stock' => [
                'required',
                'numeric'
            ],
            'shop_id' => [
                'required',
                'string',
            ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => $validator->errors()->toArray(),
            ], 403)
        );
    }
}

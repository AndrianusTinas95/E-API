<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        switch ($this->method) {
            case 'POST':
                return [
                    'name'      => 'required|max:200|unique:products',
                    'detail'    => 'required',
                    'price'     => 'required|max:10',
                    'stock'     => 'required|max:6',
                    'discount'  => 'required|max:2',
                ];
                break;
            
            default:
                return [
                    'name'      => 'nullable|max:200|unique:products,name,',
                    'detail'    => 'nullable',
                    'price'     => 'nullable|max:10',
                    'stock'     => 'nullable|max:6',
                    'discount'  => 'nullable|max:2',
                ];
                break;
        }

    }
}

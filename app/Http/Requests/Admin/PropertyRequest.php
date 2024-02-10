<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'sale_price'  => str_replace(',', '.', str_replace('.', '', str_replace('R$ ', '', $this->sale_price))),
            'rent_price'  => str_replace(',', '.', str_replace('.', '', str_replace('R$ ', '', $this->rent_price))),
            'condominium'  => str_replace(',', '.', str_replace('.', '', str_replace('R$ ', '', $this->condominium))),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title'  => 'required|max:191',
            'headline'  => 'required|max:191',
            'cover' => 'image|mimes:jpg,png,jpeg,gif,svg,webp|max:4096|dimensions:max_width=4000,max_height=4000',
            'experience_id' => 'required|exists:experiences,id',
            'type_id' => 'required|exists:types,id',
            'goal' => 'required|in:Venda,Locação,Venda ou Locação',
            'status' => 'required|in:Disponível,Indisponível',            
            'owner' => 'nullable|max:191',
            'sale_price' => 'nullable||numeric|between:0,999999999.999',
            'rent_price' => 'nullable||numeric|between:0,999999999.999',
            'condominium' => 'nullable||numeric|between:0,999999999.999',
            'description' => 'required|max:400000000',
            //ok

            // 'bedrooms',
            // 'suites', 'bathrooms', 'rooms', 'garage', 'garage_covered', 'area_total', 'area_util',
            // 'zipcode', 'street', 'number', 'complement', 'neighborhood', 'state', 'city',
            // 'user_id', 'agency_id', 'client_id',
        ];
    }
}

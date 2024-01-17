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

    public function prepareForValidation()
    {
        $sale = false;
        $rent = false;

        switch ($this->goal) {
            case 'Venda':
                $sale = true;
                break;
            case 'Locação':
                $rent = true;
                break;
            case 'Venda ou Locação':
                $sale = true;
                $rent = true;
                break;
            default:
                $sale = true;
                break;
        }
        $this->merge([
            'sale' => $sale,
            'rent' => $rent,
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
            'experiences_id' => 'required|exists:experiences,id',
            // 'experience', 'sale', 'rent',
            'category' => 'required',
            'type' => 'required',
            'sale_price' => 'required_if:sale,on',
            'rent_price' => 'required_if:rent,on',
            // 'tribute', 'condominium', 'description', 'bedrooms',
            // 'suites', 'bathrooms', 'rooms', 'garage', 'garage_covered', 'area_total', 'area_util',
            // 'zipcode', 'street', 'number', 'complement', 'neighborhood', 'state', 'city', 'air_conditioning',
            // 'bar', 'library', 'barbecue_grill', 'american_kitchen', 'fitted_kitchen', 'pantry', 'shed',
            // 'office', 'bathtub', 'fireplace', 'lavatory', 'furnished', 'pool', 'steam_room', 'view_of_the_sea',
            // 'status', 'user_id', 'agency_id', 'client_id', 'owner',
        ];
    }
}

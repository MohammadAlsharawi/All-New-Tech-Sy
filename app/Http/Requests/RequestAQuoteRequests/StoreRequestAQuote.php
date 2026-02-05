<?php

namespace App\Http\Requests\RequestAQuoteRequests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequestAQuote extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' =>'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'post_code' => 'required|string|max:10',
            'property_type_id' => 'required|exists:property_types,id',
            'service_id' => 'required|exists:services,id',
            'requirements' => 'required|string',
            'preferred_contact_method_id' => 'required|exists:preferred_contact_methods,id',
            'budget_range_id' => 'required|exists:budget_ranges,id',
            'file' => 'required|file|mimes:pdf|max:10240',
            'confirmation' => 'required|boolean'
        ];
    }
}

<?php

namespace App\Http\Requests\BookASiteVisitRequests;

use Illuminate\Foundation\Http\FormRequest;

class BookASiteVisitRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'post_code' => 'required|string|max:50',

            'property_type_id' => 'required|exists:property_types,id',
            'service_id' => 'required|exists:services,id',
            'preferred_time_id' => 'required|exists:preferred_times,id',

            'address' => 'required|string|max:255',

            'preferred_date' => 'required|date|after_or_equal:today',

            'notes' => 'nullable|string',

            'confirmation' => 'sometimes|boolean',
        ];
    }
}

<?php

namespace App\Http\Requests\Front;

use App\Models\Quote;
use App\Models\Customer;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreQuoteRequest extends FormRequest
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
        $customer = Customer::query()->where('email', $this->email)->first();

        return [
            'civility' => 'required|in:' . implode(',', array_keys(Quote::CIVILITY)),
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('customers', 'email'),
            ],
            'phone' => 'required|string|max:20',
            'zip_code' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'details' => 'required|string',
            'budget' => 'required|numeric|min:0',
            'currency' => 'required|in:' . implode(',', array_keys(config('currencies'))),
            // 'project_department' => 'required|string|max:255',
            'project_city' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ];
    }
}

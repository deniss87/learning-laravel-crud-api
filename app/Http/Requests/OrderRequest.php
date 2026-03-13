<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
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
        $orderId = $this->route('order') ? $this->route('order')->id : null;

        return [
            'customer_id'  => ['required', 'exists:customers,id'],
            'order_number' => [
                'required',
                'string',
                Rule::unique('orders', 'order_number')->ignore($this->route('order')),
            ],
            'total_amount' => ['required', 'numeric', 'min:0'],
            'status'       => ['required', 'in:pending,processing,completed,cancelled'],
        ];
    }
}

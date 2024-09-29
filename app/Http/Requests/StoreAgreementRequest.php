<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class StoreAgreementRequest extends FormRequest
{
    // protected $stopOnFirstFailure = true;
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
    public function rules(Request $request)
    {
        return [
            'agreement_type' => [
                'required',
                Rule::in(['sale', 'rental']),
            ],
            'agreement_date' => ['required', 'string', 'max:40'],
            'start_date' => ['exclude_if:agreement_type,sale','nullable', 'string', 'max:10'],
            'end_date' => ['exclude_if:agreement_type,sale','nullable', 'string', 'max:10'],
            'rent_term' => ['exclude_if:agreement_type,sale','nullable', 'string', 'max:30'],
            'adviser' => ['nullable', 'string', 'max:40'],
            'customer_name' => ['required', 'string', 'max:30'],
            'customer_birth' => ['nullable', 'string', 'max:10'],
            'customer_tel' => ['nullable', 'digits:11'],
            'owner_name' => ['required', 'string', 'max:30'],
            'owner_birth' => ['nullable', 'string', 'max:10'],
            'owner_tel' => ['nullable', 'digits:11'],
            'description' => ['nullable', 'string'],
            'mortgage_price' => ['exclude_if:agreement_type,sale', Rule::requiredIf($request->get('type') === 'rental'), 'nullable', 'numeric'],
            'rent_price' => ['exclude_if:agreement_type,sale', Rule::requiredIf($request->get('type') === 'rental'), 'nullable', 'numeric'],
            'sell_price' => ['exclude_if:agreement_type,rental', Rule::requiredIf($request->get('type') === 'sale'), 'nullable', 'numeric'],
            'images.*' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:1024']

        ];
    }
    public function attributes()
    {
        return [
            'agreement_type'        => 'نوع قرارداد',
            'agreement_date'        => 'تاریخ عقد قرارداد',
            'adviser'        => 'نام مشاور',
            'owner'        => 'نام مالک',
            'customer'        => 'نام مشتری',
            'rent-term'        => 'مدت اجاره ',
            'start_date'        => 'تاریخ شروع قرارداد',
            'end_date'        => 'تاریخ اتمام قرارداد',
            'mortgage_price'        => 'مبلغ رهن',
            'rent_price'        => 'مبلغ اجاره',
            'sell-price'        => 'مبلغ فروش',
            'image'        => 'عکس',
            'images.*'        => 'عکس ها',
        ];
    }
}

<?php

namespace App\Livewire\Forms;

use App\Models\Agreement;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AgreementForm extends Form
{
    #[Validate("required|in:sale,rental")]
    public $agreement_type;
    #[Validate("required|date")]
    public $agreement_date;
    #[Validate("required_if:agreement_type,rental|nullable|date")]
    public $start_date;
    #[Validate("required_if:agreement_type,rental|nullable|date")]
    public $end_date;
    #[Validate('required_if:agreement_type,rental|nullable|string|max:30')]
    public $rent_term;
    #[Validate('required_if:agreement_type,rental|nullable')]
    public $mortgage_price;
    #[Validate('required_if:agreement_type,rental|nullable')]
    public $rent_price;
    #[Validate('nullable|string|max:40')]
    public $adviser;
    #[Validate('required|string|max:40')]
    public $customer_name;
    #[Validate('nullable|date')]
    public $customer_birth;
    #[Validate('nullable|ir_mobile')]
    public $customer_tel;
    #[Validate('required|string|max:30')]
    public $owner_name;
    #[Validate('nullable|date')]
    public $owner_birth;
    #[Validate('nullable|ir_mobile')]
    public $owner_tel;
    #[Validate('nullable|string')]
    public $description;
    #[Validate('required_if:agreement_type,sale|nullable')]
    public $sell_price;
    #[Validate(['images'   => 'array',
                'images.*' => 'image|mimes:jpeg,jpg,png|max:2044'], attribute: ['images.*' => 'فایل انتخابی'])]
    public $images = [];

    public function format_prices()
    {
        if ($this->sell_price) {
            $this->sell_price = (int)str_replace(',', '', $this->sell_price);
        }
        if ($this->rent_price) {
            $this->rent_price = (int)str_replace(',', '', $this->rent_price);
        }
        if ($this->mortgage_price) {
            $this->mortgage_price = (int)str_replace(',', '', $this->mortgage_price);
        }
    }


    public function setAgreement($agreement): void
    {
        if ($agreement['sell_price']) {
            $agreement['sell_price'] = number_format((int)$agreement['sell_price']);
        }
        if ($agreement['rent_price']) {
            $agreement['rent_price'] = number_format((int)$agreement['rent_price']);
        }
        if ($agreement['mortgage_price']) {
            $agreement['mortgage_price'] = number_format((int)$agreement['mortgage_price']);
        }

        $this->fill($agreement);
    }
}

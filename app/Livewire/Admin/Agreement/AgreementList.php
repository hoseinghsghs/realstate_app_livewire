<?php

namespace App\Livewire\Admin\Agreement;

use App\Models\Agreement;

//use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class AgreementList extends Component
{
    use WithPagination;
    public $numberOfPaginatorsRendered = [];

    public $agreement;
    #[Validate("nullable|string|in:sale,rental,''")]
    public $agreement_type = '';
    #[Validate("nullable|string")]
    public $name_lastname = '';
    #[Validate("nullable|date")]
    public $agreement_date = null;

    public function delete_agreement(Agreement $agreement)
    {
        $this->agreement = $agreement;
        sweetalert()->timer(0)->showConfirmButton(true, 'بله')
            ->showDenyButton(true, 'انصراف')
            ->info('از حذف رکورد مورد نظر اطمینان دارید؟');
    }

    #[On('sweetalert:confirmed')]
    public function onConfirmed(): void
    {
        DB::beginTransaction();

        try {
            //delete uploaded images
            $photos = $this->agreement->images;
            if (count($photos) > 0) {
                foreach ($photos as $photo) {
                    if (Storage::exists($this->photo->url)) {
                        Storage::delete($this->photo->url);
                    }
                }
                $photos->delete();
            }
            // delete agreement
            $this->agreement->delete();

            $this->agreement = null;
            flash()->success('قولنامه با موفقیت حذف شد');

            DB::commit();
        } catch (\Exception $e) {
            // something went wrong
            DB::rollback();
            flash()->error($e->getMessage());
        }
    }

    #[On('sweetalert:denied')]
    public function onDeny(): void
    {
        $this->agreement = null;
    }

    public function render()
    {
        $this->validate();
        $agreements = Agreement::when($this->agreement_type, function ($query) {
            $query->where('agreement_type', $this->agreement_type);
        })->when($this->name_lastname, function ($query) {
            $query->whereAny(['customer_name', 'owner_name'], 'like', '%' . $this->name_lastname . '%');
        })->when($this->agreement_date, function ($query) {
            $date_time = explode(' ', $this->agreement_date);
            $query->whereDate('agreement_date', $date_time[0]);
        })->latest()->paginate(10);

        return view('livewire.admin.pages.agreement.agreement-list', compact(['agreements']))->extends('livewire.admin.layout.MasterAdmin')->section('Content');
    }
}

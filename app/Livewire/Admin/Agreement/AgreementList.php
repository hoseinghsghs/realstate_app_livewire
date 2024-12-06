<?php

namespace App\Livewire\Admin\Agreement;

use App\Models\Agreement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
class AgreementList extends Component
{
    use WithPagination;

    public $agreement;
    public function delete_agreement(Agreement $agreement)
    {
        $this->agreement=$agreement;
        sweetalert()->timer(0)->showConfirmButton(true,'بله')
            ->showDenyButton(true,'انصراف')
            ->info('از حذف رکورد مورد نظر اطمینان دارید؟');
    }
    #[On('sweetalert:confirmed')]
    public function onConfirmed(array $payload): void
    {
        DB::beginTransaction();

        try {
            //delete uploaded images
            $photos = $this->agreement->images;
            if (count($photos)>0) {
                foreach ($photos as $photo) {
                    if (Storage::exists($this->photo->url)) {
                        Storage::delete($this->photo->url);
                    }
                }
                $photos->delete();
            }
            // delete agreement
            $this->agreement->delete();

            $this->agreement=null;
            flash()->success('قولنامه با موفقیت حذف شد');

            DB::commit();

        } catch (\Exception $e) {
            // something went wrong
            DB::rollback();
            flash()->error($e->getMessage());
        }
    }
    #[On('sweetalert:denied')]
    public function onDeny(array $payload): void
    {
        $this->agreement=null;
    }
    public function render()
    {
        $agreements = Agreement::latest()->paginate(10);
        return view('livewire.admin.agreement.agreement-list', compact(['agreements']))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}

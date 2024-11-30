<?php

namespace App\Livewire\Admin\Agreement;

use App\Models\Agreement;
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
//
    }
    #[On('sweetalert:confirmed')]
    public function onConfirmed(array $payload): void
    {
        $this->agreement->delete();
        flash()->success('قولنامه با موفقیت حذف شد');
    }
    #[On('sweetalert:denied')]
    public function onDeny(array $payload): void
    {
        $this->agreement=null;
    }
    public function render()
    {
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        $agreements = Agreement::latest()->paginate(10);
        return view('livewire.admin.agreement.agreement-list', compact(['agreements']))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}

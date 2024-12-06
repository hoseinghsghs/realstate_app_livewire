<?php

namespace App\Livewire\Admin\Agreement;

use App\Livewire\Forms\AgreementForm;
use App\Models\Agreement;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateAgreement extends Component
{
    use WithFileUploads;

    public AgreementForm $form;

    public function mount()
    {
        $this->form->agreement_type = 'rental';
//        $this->form->images = [];
    }

    public function save()
    {
        $this->form->format_prices();
        $this->validate();

        DB::beginTransaction();

        try {
            $this->agreement->update($this->form->except('images'));
            //upload images
            if (count($this->form->images) > 0) {
                $paths = [];
                foreach ($this->form->images as $image) {
                    $path = $image->store(path: 'agreement');
                    $paths[] = ['url' => $path];
                }
                $this->agreement->images()->createMany($paths);
            }
            // reset temporary images
            $this->form->images = [];
            flash()->success('تغییرات با موفقیت ذخیره شد.');

            DB::commit();

            flash()->success('قولنامه با موفقیت ایجاد شد.');
            return $this->redirect(route('admin.agreements.index'), navigate: true);
        } catch (\Exception $e) {
            // something went wrong
            DB::rollback();

            $this->form->reset();
            flash()->error($e->getMessage());
        }
    }

    public function delete_temp_image($id): void
    {
        if (array_key_exists($id, $this->form->images)) {
            unset($this->form->images[$id]);
        }
    }

    public function render()
    {
        return view('livewire.admin.agreement.create-agreement')->extends('admin.layout.MasterAdmin')->section('Content');
    }
}

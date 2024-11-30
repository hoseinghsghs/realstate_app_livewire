<?php

namespace App\Livewire\Admin\Agreement;

use App\Livewire\Forms\AgreementForm;
use App\Models\Agreement;
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
        $this->validate();

        $agreement = Agreement::create($this->form->except('images'));
        //upload images
        if (count($this->form->images) > 0) {
            $paths = [];
            foreach ($this->form->images as $image) {
                $path = $image->store(path: 'agreement');
                $paths[] = ['url' => $path];
            }
            $agreement->images()->createMany($paths);
        }
        flash()->success('قولنامه با موفقیت ایجاد شد.');
        return $this->redirect(route('admin.agreements.index'), navigate: true);
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

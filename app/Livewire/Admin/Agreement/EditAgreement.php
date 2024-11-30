<?php

namespace App\Livewire\Admin\Agreement;

use App\Livewire\Forms\AgreementForm;
use App\Models\Agreement;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditAgreement extends Component
{
    use WithFileUploads;

    public Agreement $agreement;
    public AgreementForm $form;
    public Image|null $photo = null;

    public function mount(Agreement $agreement): void
    {
        $this->agreement = $agreement;
        $this->form->setAgreement($agreement);
    }

    public function update()
    {
        $this->validate();

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
//        return $this->redirect(route('admin.agreements.index'), navigate: true);
    }

    public function delete_photo(Image $photo): void
    {
        sweetalert()->timer(0)->showConfirmButton(true, 'بله')
            ->showDenyButton(true, 'انصراف')
            ->info('عکس مورد نظر حذف شود؟');
        $this->photo = $photo;
    }

    #[On('sweetalert:confirmed')]
    public function onConfirmed(array $payload): void
    {
        if (Storage::exists($this->photo->url)) {
            Storage::delete($this->photo->url);
        }
        $this->photo->delete();
        flash()->success('تصویر با موفقیت حذف گردید');
    }

    #[On('sweetalert:denied')]
    public function onDeny(array $payload): void
    {
        $this->photo = null;
    }

    public function delete_temp_image($id): void
    {
        if (array_key_exists($id, $this->form->images)) {
            unset($this->form->images[$id]);
        }
    }

    public function render()
    {
        $photos = $this->agreement->images;
        return view('livewire.admin.agreement.edit-agreement', compact('photos'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}

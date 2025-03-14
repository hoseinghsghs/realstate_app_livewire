<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
    public $name, $email, $password, $password_confirmation;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ];

    public function register()
    {
        $this->validate();

        if (isset($input['role_id'])) {
            $input['role_id'] = 2;
        } else {
            $input['role_id'] = 3;
        }

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role_id' => $input['role_id'],

        ]);

        Auth::login($user);
        flash()->success('ثبت نام انجام شد');
        return $this->redirect('/', navigate: true);

        // return redirect()->to('/');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}

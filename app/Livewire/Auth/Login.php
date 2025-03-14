<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email, $password, $remember = false;
    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];
    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            flash()->success('ورود انجام شد');
            return $this->redirect('/', navigate: true);
        } else {
            $this->addError('email', 'اطلاعات ورود نادرست است.');
        }
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}

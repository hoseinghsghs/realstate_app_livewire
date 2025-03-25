<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;

    public function render()
    {
        $users = User::where('role_id', 2)->latest()->paginate(10);
        // return view('admin.page.users.index',compact('users'));

        return view('livewire.admin.user.user-list', compact('users'))->extends('livewire.admin-layout.layout.MasterAdmin')->section('Content');
    }
}

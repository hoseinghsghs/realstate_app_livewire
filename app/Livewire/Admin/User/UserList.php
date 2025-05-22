<?php

namespace App\Livewire\Admin\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;

    public $numberOfPaginatorsRendered = [];
    protected $paginationTheme = 'bootstrap';

    public $search = "";
    public $roleId = null;
    public $roles = [];

    public function mount()
    {
        $this->roles = Role::all();
    }

    public function render()
    {
        $users =
            User::latest()->whereAny(["email", "name"], 'like', '%' . $this->search . '%')
                ->when($this->roleId, function (Builder $query) {
                    return $query->whereHas('role', function (Builder $query) {
                        $query->where('id', $this->roleId);
                    });
                })->with('role')->paginate(10);

        return view('livewire.admin.pages.user.user-list', compact('users'))
            ->extends('livewire.admin.layout.MasterAdmin')->section('Content');
    }
}

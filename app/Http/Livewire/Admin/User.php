<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: User.php
 * User: ${USER}
 * Date: 31.${MONTH_NAME_FULL}.2023
 * Time: 08:01
 */

namespace App\Http\Livewire\Admin;

use App\Models\User as UserModel;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class User extends Component
{
    use WithPagination;

//    public $users;

    public $user;

    public $name;

    public $email;

    public $password;

    public $password_confirmation;

    public $userRole;

    public $roles;

    public $role = [];

    public $amount = 15;

    public $selected_id = '';

    public $updateMode = false;

    public $createMode = false;

    public $showMode = false;

    public $confirming;

    public $pages;

    public $search = '';

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function store(UserModel $user)
    {
        $validate = $this->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        $userId = $user->create(array_merge($validate));
        $userId->assignRole([$this->role]);
        session()->flash('success', 'Der Benutzer wurde erfolgreich angelegt.');
        $this->resetInput();
        $this->emit('refreshComponent');
        $this->createMode = false;
    }

    public function create()
    {
        $this->resetInput();
        $this->pages = [
            'link' => [
                'text' => __('Users').' '.__('Create'),
            ],
        ];
        $this->createMode = true;
    }

    public function resetInput()
    {
        $this->name = null;
        $this->email = null;
        $this->password = null;
        $this->password_confirmation = null;
        $this->role = null;
        $this->pages = [];
    }

    public function edit(UserModel $user)
    {
        $this->user = $user;
        $this->selected_id = $this->user->id;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->role = $user->roles->pluck('name')->toArray();
        $this->roles = Role::latest()->get();
        $this->pages = [
            'link' => [
                'text' => __('Edit').' '.$this->user->name,
            ],
        ];
        $this->updateMode = true;
    }

    public function cancel()
    {
    }

    public function show($user)
    {
        $this->user = UserModel::with('roles')->findOrFail($user);
        $this->pages = [
            'link' => [
                'text' => $this->user->name,
            ],
        ];
        $this->showMode = true;
//        return redirect()->route('admin.users.show', $user);
    }

    public function update()
    {
        $user = UserModel::find($this->selected_id);
        $validate = $this->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email,'.$user->id,
        ]);
        if ($this->selected_id) {
            $user->update($validate);
            $user->syncRoles([$this->role]);
            session()->flash('success', 'Die Änderung an den Benutzerdaten wurden erfolgreich ausgeführt.');
            $this->resetInput();
            $this->emit('refreshComponent');
            $this->updateMode = false;
        }
    }

    public function updateModeClose()
    {
        $this->updateMode = false;
        $this->createMode = false;
        $this->showMode = false;
        $this->resetInput();
        $this->emit('refreshComponent');
    }

    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function delete($id)
    {
        UserModel::where('id', $id)->delete();

        return redirect(request()->header('Referer'))->with('success', 'Der Benutzer wurde gelöscht.');
    }

    public function load()
    {
        $this->amount += 15;
    }

    public function mount()
    {
        $this->roles = Role::all();
    }

    public function render()
    {
        $users = UserModel::where('name', 'like', '%'.$this->search.'%')
            ->with('roles')->with('permissions')->latest()->paginate(15);

        return view('livewire.admin.users.user', ['users' => $users]);
    }
}

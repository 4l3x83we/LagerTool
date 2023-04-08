<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Role.php
 * User: ${USER}
 * Date: 31.${MONTH_NAME_FULL}.2023
 * Time: 08:01
 */

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission as PermissionModel;
use Spatie\Permission\Models\Role as RoleModel;

class Role extends Component
{
    use WithPagination;

    public $role;

    public $roles;

    public $permissions;

    public $permission;

    public $name;

    public $selected_id;

    public $createMode = false;

    public $showMode = false;

    public $updateMode = false;

    public $rolePermissions;

    public $pages = [];

    public $confirming;

    public function store()
    {
        $validate = $this->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $role = RoleModel::create(['name' => $this->name]);
        $role->givePermissionTo($this->permission);
        session()->flash('success', 'Die Role wurde erfolgreich angelegt.');
        $this->resetInput();
        $this->createMode = false;
    }

    public function create()
    {
        $this->permissions = PermissionModel::all();
        $this->pages = [
            'link' => [
                'text' => __('Roles').' '.__('Create'),
            ],
        ];
        $this->createMode = true;
    }

    public function resetInput()
    {
        $this->selected_id = '';
        $this->name = '';
        $this->permission = '';
        $this->pages = [];
        $this->confirming = '';
    }

    public function show(RoleModel $role)
    {
        $this->role = $role;
        $this->rolePermissions = $role->permissions;
        $this->pages = [
            'link' => [
                'text' => $this->role->name,
            ],
        ];
        $this->showMode = true;
    }

    public function edit(RoleModel $role)
    {
        $this->role = $role;
        $this->selected_id = $role->id;
        $this->name = $role->name;
        $this->permission = $role->permissions->pluck('name')->toArray();
        $this->permissions = PermissionModel::all();
        $this->pages = [
            'link' => [
                'text' => __('Edit').' '.$this->role->name,
            ],
        ];
        $this->updateMode = true;
    }

    public function update()
    {
        $role = RoleModel::find($this->selected_id);
        $validate = $this->validate([
            'name' => 'required',
            'permission' => 'required',
        ]);
        $role->update(['name' => $this->name]);
        $role->syncPermissions([$this->permission]);
        session()->flash('success', 'Die Role wurde erfolgreich geändert.');
        $this->resetInput();
        $this->updateMode = false;
    }

    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function delete(RoleModel $role)
    {
        $role->delete();
        session()->flash('success', 'Die Role wurde gelöscht.');

        return redirect(request()->header('Referer'));
    }

    public function updateModeClose()
    {
        $this->updateMode = false;
        $this->createMode = false;
        $this->showMode = false;
        $this->resetInput();
    }

    public function mount()
    {
    }

    public function render()
    {
        $this->roles = RoleModel::orderBy('id', 'DESC')->get();

        return view('livewire.admin.roles.role', ['roles' => $this->roles]);
    }
}

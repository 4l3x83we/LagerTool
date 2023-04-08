<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Permission.php
 * User: ${USER}
 * Date: 31.${MONTH_NAME_FULL}.2023
 * Time: 08:01
 */

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Permission as PermissionModal;

class Permission extends Component
{
    public $permissions;

    public $permission;

    public $name;

    public $selected_id;

    public $confirming;

    public $pages;

    public $createMode = false;

    public $updateMode = false;

    public function store()
    {
        $validate = $this->validate([
            'name' => 'required|unique:users,name',
        ]);
        PermissionModal::create(['name' => $this->name]);
        session()->flash('success', 'Die Berechtigung wurde erfolgreich angelegt.');
        $this->resetInput();
        $this->createMode = false;
    }

    public function create()
    {
        $this->pages = [
            'link' => [
                'text' => __('Permissions').' '.__('Create'),
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

    public function edit(PermissionModal $permission)
    {
        $this->permission = $permission;
        $this->selected_id = $permission->id;
        $this->name = $permission->name;
        $this->pages = [
            'link' => [
                'text' => __('Permissions').' '.__('Create'),
            ],
        ];
        $this->updateMode = true;
    }

    public function update()
    {
        $permission = PermissionModal::find($this->selected_id);
        $validate = $this->validate([
            'name' => 'required',
            'permission' => 'required',
        ]);
        $permission->update(['name' => $this->name]);
        session()->flash('success', 'Die Berechtigung wurde erfolgreich geändert.');
        $this->resetInput();
        $this->updateMode = false;
    }

    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function delete(PermissionModal $permission)
    {
        $permission->delete();
        session()->flash('success', 'Die Berechtigung wurde gelöscht.');

        return redirect(request()->header('Referer'));
    }

    public function updateModeClose()
    {
        $this->updateMode = false;
        $this->createMode = false;
        $this->resetInput();
    }

    public function render()
    {
        $this->permissions = PermissionModal::all();

        return view('livewire.admin.permission.permission');
    }
}

<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Settings.php
 * User: ${USER}
 * Date: 03.${MONTH_NAME_FULL}.2023
 * Time: 08:49
 */

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Settings extends Component
{
    public $test;

    public function render()
    {
        return view('livewire.admin.settings');
    }
}

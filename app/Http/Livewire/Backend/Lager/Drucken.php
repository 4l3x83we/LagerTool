<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Drucken.php
 * User: ${USER}
 * Date: 02.${MONTH_NAME_FULL}.2023
 * Time: 08:33
 */

namespace App\Http\Livewire\Backend\Lager;

use App\Models\Backend\Lager\Lager;
use Livewire\Component;

class Drucken extends Component
{
    public $lager = 2;

    public function mount(Lager $id)
    {
        $this->lager = $id;
    }

    public function render()
    {
        return view('livewire.backend.lager.drucken');
    }
}

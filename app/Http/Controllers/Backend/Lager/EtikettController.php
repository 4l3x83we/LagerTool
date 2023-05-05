<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: EtikettController.php
 * User: ${USER}
 * Date: 02.${MONTH_NAME_FULL}.2023
 * Time: 11:33
 */

namespace App\Http\Controllers\Backend\Lager;

use App\Http\Controllers\Controller;
use App\Models\Backend\Lager\Lager;
use Barryvdh\DomPDF\Facade\Pdf;

class EtikettController extends Controller
{
    public function index(Lager $id)
    {
        $lager = $id;

        return Pdf::loadView('backend.etikett', compact('lager'))->stream();
    }
}

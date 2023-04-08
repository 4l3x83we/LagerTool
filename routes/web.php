<?php

use App\Http\Livewire\Admin\Settings\Einheiten;
use App\Http\Livewire\Admin\Settings\Emissionsklasse;
use App\Http\Livewire\Admin\Settings\FahrzeugDatenHersteller;
use App\Http\Livewire\Admin\Settings\Hersteller;
use App\Http\Livewire\Admin\Settings\HerstellerArtikel;
use App\Http\Livewire\Admin\Settings\Model;
use App\Http\Livewire\Admin\Settings\MwSt;
use App\Http\Livewire\Admin\Settings\Stammdaten;
use App\Http\Livewire\Admin\Settings\Warengruppe;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::name('admin.')->middleware(['auth', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::prefix('benutzerverwaltung')->group(function () {
        Route::get('/users', function () {
            return view('admin.benutzerverwaltung.users');
        })->name('users');

        Route::get('/roles', function () {
            return view('admin.benutzerverwaltung.roles');
        })->name('roles');

        Route::get('/permission', function () {
            return view('admin.benutzerverwaltung.permission');
        })->name('permission');
    });

    Route::name('settings.')->group(function () {
        Route::get('/einstellungen/firma', Stammdaten::class)->name('firma');
        Route::get('/einstellungen/steuern', MwSt::class)->name('steuern');
        Route::get('/einstellungen/hersteller-artikel', HerstellerArtikel::class)->name('hersteller-artikel');
        Route::get('/einstellungen/einheiten', Einheiten::class)->name('einheiten');
        Route::get('/einstellungen/warengruppe', Warengruppe::class)->name('warengruppe');
        Route::get('/einstellungen/hersteller', Hersteller::class)->name('hersteller');
        Route::get('/einstellungen/model', Model::class)->name('model');
        Route::get('/einstellungen/fahrzeugdaten', FahrzeugDatenHersteller::class)->name('fahrzeugdaten');
        Route::get('/einstellungen/emissionsklasse', Emissionsklasse::class)->name('emissionsklasse');
    });
});

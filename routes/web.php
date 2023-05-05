<?php

use App\Http\Controllers\Backend\Lager\EtikettController;
use App\Http\Livewire\Admin\Settings\Einheiten;
use App\Http\Livewire\Admin\Settings\Emissionsklasse;
use App\Http\Livewire\Admin\Settings\FahrzeugDatenHersteller;
use App\Http\Livewire\Admin\Settings\Hersteller;
use App\Http\Livewire\Admin\Settings\HerstellerArtikel;
use App\Http\Livewire\Admin\Settings\HSN;
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

    Route::prefix('einstellungen')->name('settings.')->group(function () {
        Route::get('/firma', Stammdaten::class)->name('firma');
        Route::get('/steuern', MwSt::class)->name('steuern');
        Route::get('/hersteller-artikel', HerstellerArtikel::class)->name('hersteller-artikel');
        Route::get('/einheiten', Einheiten::class)->name('einheiten');
        Route::get('/warengruppe', Warengruppe::class)->name('warengruppe');
        Route::get('/hersteller', Hersteller::class)->name('hersteller');
        Route::get('/model', Model::class)->name('model');
        Route::get('/fahrzeugdaten', FahrzeugDatenHersteller::class)->name('fahrzeugdaten');
        Route::get('/emissionsklasse', Emissionsklasse::class)->name('emissionsklasse');
        Route::get('/hsn', HSN::class)->name('hsn');
    });
});

Route::prefix('backend')->name('backend.')->middleware(['auth', config('jetstream.auth_session'), 'verified'])->group(function () {
    // Kunden
    Route::get('/kunden', App\Http\Livewire\Backend\Kunden\Index::class)->name('kunden');
    Route::get('/kunden/erstellen', App\Http\Livewire\Backend\Kunden\Create::class)->name('kunden.create');
    Route::get('/kunden/{id}/bearbeiten', App\Http\Livewire\Backend\Kunden\Edit::class)->name('kunden.edit');
    Route::get('/kunden/{id}', App\Http\Livewire\Backend\Kunden\Show::class)->name('kunden.show');
    // Artikel
    Route::get('/artikel', App\Http\Livewire\Backend\Artikel\Index::class)->name('artikel');
    Route::get('/artikel/erstellen', App\Http\Livewire\Backend\Artikel\Create::class)->name('artikel.create');
    Route::get('/artikel/{id}/bearbeiten', App\Http\Livewire\Backend\Artikel\Edit::class)->name('artikel.edit');
    Route::get('/artikel/{id}', App\Http\Livewire\Backend\Artikel\Show::class)->name('artikel.show');
    // Fahrzeuge
    Route::get('/fahrzeuge', App\Http\Livewire\Backend\Fahrzeuge\Index::class)->name('fahrzeuge');
    Route::get('/fahrzeuge/erstellen', App\Http\Livewire\Backend\Fahrzeuge\Create::class)->name('fahrzeuge.create');
    Route::get('/fahrzeuge/{id}/bearbeiten', App\Http\Livewire\Backend\Fahrzeuge\Edit::class)->name('fahrzeuge.edit');
    Route::get('/fahrzeuge/{id}', App\Http\Livewire\Backend\Fahrzeuge\Show::class)->name('fahrzeuge.show');
    // Lager
    Route::get('/lager', App\Http\Livewire\Backend\Lager\Index::class)->name('lager');
    Route::get('/lager/{id}', App\Http\Livewire\Backend\Lager\Drucken::class)->name('lager.print');
    Route::get('/lager/etikett/{id}', [EtikettController::class, 'index'])->name('lager.etikett');
});

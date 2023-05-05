<?php

use Rawilk\Breadcrumbs\Facades\Breadcrumbs;
use Rawilk\Breadcrumbs\Support\Generator;

Breadcrumbs::for('dashboard', fn (Generator $trail) => $trail->push('Dashboard', route('dashboard')));

Breadcrumbs::for(
    'backend',
    fn (Generator $trail) => $trail->parent('dashboard')->push('Backend', route('dashboard'))
);

Breadcrumbs::for(
    'kunden',
    fn (Generator $trail) => $trail->parent('backend')->push('Kunden', route('backend.kunden'))
);

Breadcrumbs::for(
    'kundenCreate',
    fn (Generator $trail) => $trail->parent('kunden')->push('Neuen Kunden hinzufügen', route('backend.kunden.create'))
);

Breadcrumbs::for(
    'kundenEdit',
    fn (Generator $trail, $kunde) => $trail->parent('kunden')->push('Bearbeite '.$kunde->fullname(), route('backend.kunden.edit', $kunde->id))
);

Breadcrumbs::for(
    'kundenShow',
    fn (Generator $trail, $kunde) => $trail->parent('kunden')->push($kunde->fullname(), route('backend.kunden.show', $kunde->id))
);

Breadcrumbs::for(
    'artikel',
    fn (Generator $trail) => $trail->parent('backend')->push('Artikel', route('backend.artikel'))
);

Breadcrumbs::for(
    'artikelCreate',
    fn (Generator $trail) => $trail->parent('artikel')->push('Neuen Artikel anlegen', route('backend.artikel.create'))
);

Breadcrumbs::for(
    'artikelEdit',
    fn (Generator $trail, $artikel) => $trail->parent('artikel')->push('Bearbeite '.$artikel->art_name, route('backend.artikel.edit', $artikel->id))
);

Breadcrumbs::for(
    'artikelShow',
    fn (Generator $trail, $artikel) => $trail->parent('artikel')->push($artikel->art_name, route('backend.artikel.show', $artikel->id))
);

Breadcrumbs::for(
    'fahrzeuge',
    fn (Generator $trail) => $trail->parent('backend')->push('Fahrzeuge', route('backend.fahrzeuge'))
);

Breadcrumbs::for(
    'fahrzeugeCreate',
    fn (Generator $trail) => $trail->parent('fahrzeuge')->push('Neues Fahrzeug anlegen', route('backend.fahrzeuge.create'))
);

Breadcrumbs::for(
    'fahrzeugeEdit',
    fn (Generator $trail, $fahrzeug) => $trail->parent('fahrzeuge')->push('Bearbeite '.$fahrzeug->fullname(), route('backend.fahrzeuge.edit', $fahrzeug->id))
);

Breadcrumbs::for(
    'fahrzeugeShow',
    fn (Generator $trail, $fahrzeug) => $trail->parent('fahrzeuge')->push($fahrzeug->fullname(), route('backend.fahrzeuge.show', $fahrzeug->id))
);

Breadcrumbs::for(
    'lager',
    fn (Generator $trail) => $trail->parent('backend')->push('Lager', route('backend.lager'))
);

Breadcrumbs::for(
    'lagerCreate',
    fn (Generator $trail) => $trail->parent('lager')->push('Neuen Lagerplatz anlegen', route('backend.lager.create'))
);

Breadcrumbs::for(
    'lagerEdit',
    fn (Generator $trail, $lager) => $trail->parent('lager')->push('Bearbeite '.$lager->fullname(), route('backend.lager.edit', $lager->id))
);

Breadcrumbs::for(
    'lagerShow',
    fn (Generator $trail, $lager) => $trail->parent('lager')->push($lager->fullname(), route('backend.lager.show', $lager->id))
);

Breadcrumbs::for(
    'benutzerverwaltung',
    fn (Generator $trail) => $trail->parent('dashboard')->push('Benutzerverwaltung', route('dashboard'))
);

Breadcrumbs::for(
    'benutzerVerwalten',
    fn (Generator $trail) => $trail->parent('benutzerverwaltung')->push('Benutzer verwalten', route('admin.users'))
);

Breadcrumbs::for(
    'rollen',
    fn (Generator $trail) => $trail->parent('benutzerverwaltung')->push('Rollen', route('admin.roles'))
);

Breadcrumbs::for(
    'berechtigungen',
    fn (Generator $trail) => $trail->parent('benutzerverwaltung')->push('Berechtigungen', route('admin.permission'))
);

Breadcrumbs::for(
    'einstellungen',
    fn (Generator $trail) => $trail->parent('dashboard')->push('Einstellungen', route('admin.settings.firma'))
);

Breadcrumbs::for(
    'firma',
    fn (Generator $trail) => $trail->parent('einstellungen')->push('Firma', route('admin.settings.firma'))
);

Breadcrumbs::for(
    'mwst',
    fn (Generator $trail) => $trail->parent('einstellungen')->push('Mehrwertsteuer', route('admin.settings.steuern'))
);

Breadcrumbs::for(
    'herstellerArtikel',
    fn (Generator $trail) => $trail->parent('einstellungen')->push('Hersteller Artikel', route('admin.settings.hersteller-artikel'))
);

Breadcrumbs::for(
    'hersteller',
    fn (Generator $trail) => $trail->parent('einstellungen')->push('Hersteller', route('admin.settings.hersteller'))
);

Breadcrumbs::for(
    'einheiten',
    fn (Generator $trail) => $trail->parent('einstellungen')->push('Einheiten', route('admin.settings.einheiten'))
);

Breadcrumbs::for(
    'warengruppe',
    fn (Generator $trail) => $trail->parent('einstellungen')->push('Warengruppe', route('admin.settings.warengruppe'))
);

Breadcrumbs::for(
    'model',
    fn (Generator $trail) => $trail->parent('einstellungen')->push('Fahrzeugmodell', route('admin.settings.model'))
);

Breadcrumbs::for(
    'hsn',
    fn (Generator $trail) => $trail->parent('einstellungen')->push('HSN', route('admin.settings.hsn'))
);

Breadcrumbs::for(
    'tsn',
    fn (Generator $trail) => $trail->parent('einstellungen')->push('TSN', route('admin.settings.tsn'))
);

Breadcrumbs::for(
    'fahrzeugdaten',
    fn (Generator $trail) => $trail->parent('einstellungen')->push('Fahrzeugdaten', route('admin.settings.fahrzeugdaten'))
);

Breadcrumbs::for(
    'emissionsklasse',
    fn (Generator $trail) => $trail->parent('einstellungen')->push('Emissionsklasse', route('admin.settings.emissionsklasse'))
);

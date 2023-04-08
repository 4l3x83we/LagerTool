<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Emissionsklasse extends Model
{
    protected $fillable = ['emissionsklasse', 'kat_id'];

    public static function katName($katID)
    {
        foreach (self::kat() as $kat) {
            if ($kat['id'] === $katID) {
                return $kat['name'];
            }
        }

        return null;
    }

    public static function kat()
    {
        return [
            [
                'id' => 0,
                'name' => 'EURO 0',
            ],
            [
                'id' => 1,
                'name' => 'EURO 1',
            ],
            [
                'id' => 2,
                'name' => 'EURO 2',
            ],
            [
                'id' => 3,
                'name' => 'EURO 3',
            ],
            [
                'id' => 4,
                'name' => 'EURO 4',
            ],
            [
                'id' => 5,
                'name' => 'EURO 5',
            ],
            [
                'id' => 6,
                'name' => 'EURO 6',
            ],
            [
                'id' => 7,
                'name' => 'EURO 7',
            ],
            [
                'id' => 8,
                'name' => 'EEV 1',
            ],
        ];
    }
}

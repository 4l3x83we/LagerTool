<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_04_13_090931_add_reifen_to_fahrzeuges_table.php
 * User: ${USER}
 * Date: 13.${MONTH_NAME_FULL}.2023
 * Time: 09:09
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('fahrzeuges', function (Blueprint $table) {
            $table->string('fz_reifen_1')->after('fz_getriebeart')->nullable();
            $table->string('fz_reifen_2')->after('fz_reifen_1')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('fahrzeuges', function (Blueprint $table) {
            $table->dropColumn('fz_reifen_1');
            $table->dropColumn('fz_reifen_2');
        });
    }
};

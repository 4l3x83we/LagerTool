<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_04_12_075506_add_fz_rdks_to_fahrzeuges_table.php
 * User: ${USER}
 * Date: 12.${MONTH_NAME_FULL}.2023
 * Time: 07:55
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('fahrzeuges', function (Blueprint $table) {
            $table->string('fz_rdks')->nullable()->after('fz_getriebeart');
        });
    }

    public function down(): void
    {
        Schema::table('fahrzeuges', function (Blueprint $table) {
            $table->dropColumn('fz_rdks');
        });
    }
};

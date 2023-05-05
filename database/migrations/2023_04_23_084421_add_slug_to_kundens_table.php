<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_04_23_084421_add_slug_to_kundens_table.php
 * User: ${USER}
 * Date: 23.${MONTH_NAME_FULL}.2023
 * Time: 08:44
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kundens', function (Blueprint $table) {
            $table->string('slug')->after('kd_vorname')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('kundens', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};

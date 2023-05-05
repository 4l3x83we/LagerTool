<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_04_09_231504_add_anmerkungen_to_kundens_table.php
 * User: ${USER}
 * Date: 09.${MONTH_NAME_FULL}.2023
 * Time: 23:15
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kundens', function (Blueprint $table) {
            $table->longText('kd_anmerkungen')->after('kd_anmerkungen_anzeigen');
        });
    }

    public function down(): void
    {
        Schema::table('kundens', function (Blueprint $table) {
            $table->dropColumn('kd_anmerkungen');
        });
    }
};

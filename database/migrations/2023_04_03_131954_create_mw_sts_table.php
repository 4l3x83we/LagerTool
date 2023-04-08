<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_04_03_131954_create_mw_sts_table.php
 * User: ${USER}
 * Date: 03.${MONTH_NAME_FULL}.2023
 * Time: 13:19
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mw_sts', function (Blueprint $table) {
            $table->id();
            $table->string('mw_name')->nullable();
            $table->string('mw_wert')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mw_sts');
    }
};

<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_04_03_131711_create_einheits_table.php
 * User: ${USER}
 * Date: 03.${MONTH_NAME_FULL}.2023
 * Time: 13:17
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('einheits', function (Blueprint $table) {
            $table->id();
            $table->string('eh_name')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('einheits');
    }
};

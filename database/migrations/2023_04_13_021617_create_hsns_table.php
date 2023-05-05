<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_04_13_021617_create_hsns_table.php
 * User: ${USER}
 * Date: 13.${MONTH_NAME_FULL}.2023
 * Time: 02:16
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hsns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hersteller_id')->nullable();
            $table->string('hsn', 5)->nullable();

            $table->foreign('hersteller_id')->references('id')->on('herstellers');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hsns');
    }
};

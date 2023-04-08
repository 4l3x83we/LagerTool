<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_04_03_131853_create_warengruppes_table.php
 * User: ${USER}
 * Date: 03.${MONTH_NAME_FULL}.2023
 * Time: 13:18
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('warengruppes', function (Blueprint $table) {
            $table->id();
            $table->string('wg_name')->nullable();
            $table->string('wg_slug')->unique()->nullable();
            $table->integer('wg_parent_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warengruppes');
    }
};

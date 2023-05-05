<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_04_29_074750_create_artikels_warengruppes_table.php
 * User: ${USER}
 * Date: 29.${MONTH_NAME_FULL}.2023
 * Time: 07:47
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artikels_warengruppes', function (Blueprint $table) {
            $table->unsignedBigInteger('artikel_id')->nullable();
            $table->unsignedBigInteger('warengruppe_id')->nullable();
            $table->foreign('artikel_id')->references('id')->on('artikels')->onDelete('cascade');
            $table->foreign('warengruppe_id')->references('id')->on('warengruppes')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artikels_warengruppes');
    }
};

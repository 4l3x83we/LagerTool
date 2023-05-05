<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_04_08_080646_create_datenschutzerklaerungs_table.php
 * User: ${USER}
 * Date: 08.${MONTH_NAME_FULL}.2023
 * Time: 08:06
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('datenschutzerklaerungs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kunden_id')->nullable();
            $table->date('da_erteilt_am')->nullable();
            $table->tinyInteger('da_briefe')->default(0)->nullable();
            $table->tinyInteger('da_telefon')->default(0)->nullable();
            $table->tinyInteger('da_fax')->default(0)->nullable();
            $table->tinyInteger('da_mobile')->default(0)->nullable();
            $table->tinyInteger('da_sms')->default(0)->nullable();
            $table->tinyInteger('da_whatsapp')->default(0)->nullable();
            $table->tinyInteger('da_email')->default(0)->nullable();

            $table->foreign('kunden_id')->references('id')->on('kundens')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('datenschutzerklaerungs');
    }
};

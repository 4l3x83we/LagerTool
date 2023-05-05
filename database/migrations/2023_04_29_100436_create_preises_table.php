<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_04_29_100436_create_preises_table.php
 * User: ${USER}
 * Date: 29.${MONTH_NAME_FULL}.2023
 * Time: 10:04
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('preises', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('artikel_id')->nullable();
            $table->boolean('pr_ek_anzeigen')->nullable();
            $table->decimal('pr_netto_ek', 10, 2)->nullable();
            $table->decimal('pr_brutto_ek', 10, 2)->nullable();
            $table->decimal('pr_netto_vk', 10, 2)->nullable();
            $table->decimal('pr_brutto_vk', 10, 2)->nullable();
            $table->decimal('pr_mwst', 4, 2)->nullable();
            $table->decimal('pr_prg_1_netto_vk', 10, 2)->nullable();
            $table->decimal('pr_prg_2_netto_vk', 10, 2)->nullable();
            $table->decimal('pr_prg_3_netto_vk', 10, 2)->nullable();
            $table->decimal('pr_prg_4_netto_vk', 10, 2)->nullable();
            $table->decimal('pr_prg_5_netto_vk', 10, 2)->nullable();
            $table->decimal('pr_prg_1_brutto_vk', 10, 2)->nullable();
            $table->decimal('pr_prg_2_brutto_vk', 10, 2)->nullable();
            $table->decimal('pr_prg_3_brutto_vk', 10, 2)->nullable();
            $table->decimal('pr_prg_4_brutto_vk', 10, 2)->nullable();
            $table->decimal('pr_prg_5_brutto_vk', 10, 2)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('artikel_id')->references('id')->on('artikels')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('preises');
    }
};

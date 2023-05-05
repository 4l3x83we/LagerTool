<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_04_12_075839_add_hersteller_and_model_to_fahrzeuges.php
 * User: ${USER}
 * Date: 12.${MONTH_NAME_FULL}.2023
 * Time: 07:58
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('fahrzeuges', function (Blueprint $table) {
            $table->unsignedBigInteger('hersteller_id')->nullable()->after('lager_id');
            $table->unsignedBigInteger('model_id')->nullable()->after('hersteller_id');

            $table->foreign('hersteller_id')->references('id')->on('herstellers')->onDelete('cascade');
            $table->foreign('model_id')->references('id')->on('models')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('fahrzeuges', function (Blueprint $table) {
            $table->dropForeign('fahrzeuges_hersteller_id_foreign');
            $table->dropForeign('fahrzeuges_model_id_foreign');
        });
    }
};

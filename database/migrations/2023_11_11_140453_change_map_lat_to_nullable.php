<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('catimages', function (Blueprint $table) {
            //
            $table->string('map_lat')->nullable(true)->change();
            $table->string('map_lng')->nullable(true)->change();
            $table->string('text')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('catimages', function (Blueprint $table) {
            //
            $table->string('map_lat')->nullable(false)->change();
            $table->string('map_lng')->nullable(false)->change();
            $table->dropColumn('text');
        });
    }
};

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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            // $table->string('file', 200)->nullable();
            $table->longText('file')->nullable();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->string('name', 100)->index();
            $table->string('type', 100)->nullable();
            $table->string('detail', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};

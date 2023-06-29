<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('divisions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45)->unique();
            $table->string('ambassador_name', 80);
            $table->unsignedBigInteger('parent_division_id')->nullable();
            $table->unsignedInteger('collaborators');

            $table->foreign('parent_division_id')->references('id')->on('divisions');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('divisions');
    }
};

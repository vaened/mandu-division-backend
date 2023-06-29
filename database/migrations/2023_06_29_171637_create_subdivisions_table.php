<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('subdivisions', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_division_id');
            $table->unsignedBigInteger('child_division_id');

            $table->foreign('parent_division_id')->references('id')->on('divisions');
            $table->foreign('child_division_id')->references('id')->on('divisions');

            $table->primary(['parent_division_id', 'child_division_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subdivisions');
    }
};

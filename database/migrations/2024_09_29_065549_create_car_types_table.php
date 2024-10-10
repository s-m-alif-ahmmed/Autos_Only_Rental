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
        if (!Schema::hasTable('car_types')) {
            Schema::create('car_types', function (Blueprint $table) {
                $table->id();
                $table->string('name')->nullable();
                $table->string('car_type_slug')->nullable();
                $table->string('status')->nullable()->default('Published')->comment('Published/Draft');
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_types');
    }
};

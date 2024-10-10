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
        if (!Schema::hasTable('cars')) {
            Schema::create('cars', function (Blueprint $table) {
                $table->id();
                $table->foreignId('location_id')->nullable();
                $table->text('drop_location')->nullable();
                $table->foreignId('car_type_id')->nullable();
                $table->string('name')->nullable();
                $table->text('image')->nullable();
                $table->string('alt')->nullable();
                $table->integer('quantity')->nullable();
                $table->integer('person')->nullable();
                $table->integer('seat')->nullable();
                $table->string('engine_type')->nullable();
                $table->longText('description')->nullable();
                $table->integer('day_price')->nullable();
                $table->integer('week_price')->nullable();
                $table->integer('month_price')->nullable();
                $table->string('car_slug')->nullable();
                $table->integer('view')->nullable();
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
        Schema::dropIfExists('cars');
    }
};

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
        if (!Schema::hasTable('bookings')) {
            Schema::create('bookings', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable();
                $table->foreignId('car_id')->nullable();
                $table->string('name')->nullable();
                $table->string('email')->nullable();
                $table->string('number')->nullable();
                $table->text('pickup_location')->nullable();
                $table->text('drop_location')->nullable();
                $table->date('pickup_date')->nullable();
                $table->date('drop_date')->nullable();
                $table->string('package')->nullable();
                $table->integer('price')->nullable();
                $table->string('status')->nullable()->default('Current')->comment('Current/Completed/Canceled');
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
        Schema::dropIfExists('bookings');
    }
};

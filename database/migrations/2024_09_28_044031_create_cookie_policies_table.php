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
        if (!Schema::hasTable('cookie_policies')) {
            Schema::create('cookie_policies', function (Blueprint $table) {
                $table->id();
                $table->longText('cookie_policy')->nullable();
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
        Schema::dropIfExists('cookie_policies');
    }
};

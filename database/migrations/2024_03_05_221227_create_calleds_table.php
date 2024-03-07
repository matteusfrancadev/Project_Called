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
        Schema::create('calleds', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->uuid('establishment_uuid');
            $table->uuid('user_uuid');
            $table->uuid('assigned_user_uuid')->nullable();
            $table->string('title');
            $table->text('description');
            $table->enum('status',['New','Assigned','Solved','Closed'])->default('New');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calleds');
    }
};

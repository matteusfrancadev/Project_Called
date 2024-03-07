<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('calleds', function (Blueprint $table) {
            $table->foreign('establishment_uuid')
                ->references('uuid')
                ->on('establishments')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('user_uuid')
                ->references('uuid')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('assigned_user_uuid')->null()
                ->references('uuid')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calleds', function (Blueprint $table) {
            $table->dropForeign(['establishment_uuid']);
            $table->dropColumn('establishment_uuid');
            $table->dropForeign(['user_uuid']);
            $table->dropColumn('user_uuid');
            $table->dropForeign(['assigned_user_uuid']);
            $table->dropColumn('assigned_user_uuid');
        });
    }
};

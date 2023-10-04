<?php

use App\Enums\DBTable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table(DBTable::AUTH_USERS, function (Blueprint $table) {
            $table->foreignId('current_team_id')
                  ->nullable()
                  ->constrained(DBTable::AUTH_TEAMS)
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(DBTable::AUTH_USERS, function (Blueprint $table) {
            $table->dropColumn('current_team_id');
        });
    }
};

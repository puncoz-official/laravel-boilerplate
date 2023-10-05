<?php

use App\Enums\DBTable;
use App\Infrastructure\Support\Helper;
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
        Schema::create(DBTable::AUTH_TEAMS, function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->index()->constrained(DBTable::AUTH_USERS)->cascadeOnDelete();
            $table->string('name');
            $table->boolean('personal_team');
            Helper::commonMigration($table, userInfo: true, softDelete: true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(DBTable::AUTH_TEAMS);
    }
};

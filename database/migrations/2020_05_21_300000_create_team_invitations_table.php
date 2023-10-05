<?php

use App\Enums\DBTable;
use App\Infrastructure\Support\Helper;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(DBTable::AUTH_TEAM_INVITATIONS, function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->nullable()->constrained(DBTable::AUTH_TEAMS)->cascadeOnDelete();
            $table->string('email');
            $table->string('role')->nullable();
            Helper::commonMigration($table);

            $table->unique(['team_id', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(DBTable::AUTH_TEAM_INVITATIONS);
    }
};

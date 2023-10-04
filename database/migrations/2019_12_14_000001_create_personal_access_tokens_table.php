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
        Schema::create(DBTable::AUTH_PERSONAL_ACCESS_TOKENS, function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->string('name');
            $table->string('token', 64)
                  ->unique();
            $table->text('abilities')
                  ->nullable();
            $table->timestamp('last_used_at')
                  ->nullable();
            $table->timestamp('expires_at')
                  ->nullable();
            Helper::commonMigration($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(DBTable::AUTH_PERSONAL_ACCESS_TOKENS);
    }
};

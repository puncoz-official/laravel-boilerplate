<?php

namespace App\Infrastructure\Support;

use App\Enums\DBTable;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class Helper
 */
final class Helper
{
    public static function commonMigration(
        Blueprint $table,
        bool $metadata = false,
        bool $softDelete = false,
        bool $userInfo = false
    ): Blueprint {
        if ($metadata) {
            $table->jsonb('metadata')->nullable();
        }

        if ($userInfo) {
            $table->foreignId('created_by')->nullable()->constrained(DBTable::AUTH_USERS)->cascadeOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained(DBTable::AUTH_USERS)->cascadeOnDelete();
        }

        $table->timestamps();

        if ($softDelete) {
            $table->softDeletes();

            if ($userInfo) {
                $table->foreignId('deleted_by')->nullable()->constrained(DBTable::AUTH_USERS)->cascadeOnDelete();
            }
        }

        return $table;
    }
}

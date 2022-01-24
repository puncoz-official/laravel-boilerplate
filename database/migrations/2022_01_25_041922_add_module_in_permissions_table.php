<?php

use App\Enums\DBTables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class AddModuleInPermissionsTable
 */
class AddModuleInPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(DBTables::AUTH_PERMISSIONS, function (Blueprint $table) {
            $table->foreignId('module_id')->constrained(DBTables::SYS_MODULES)->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(DBTables::AUTH_PERMISSIONS, function (Blueprint $table) {
            $table->dropColumn('module_id');
        });
    }
}

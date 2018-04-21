<?php

use App\Constants\DBTable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateActivityLogTable
 */
class CreateActivityLogTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(
            DBTable::LOGS_ACTIVITIES,
            function (Blueprint $table) {
                $table->uuid('id');
                $table->string('log_name')->nullable();
                $table->text('description');
                $table->integer('subject_id')->nullable();
                $table->string('subject_type')->nullable();
                $table->integer('causer_id')->nullable();
                $table->string('causer_type')->nullable();
                $table->text('properties')->nullable();
                $table->timestamps();

                $table->primary('id');
                $table->index('log_name');
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DBTable::LOGS_ACTIVITIES);
    }
}

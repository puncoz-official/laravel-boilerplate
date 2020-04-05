<?php

use App\Constants\DBTable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateUsersTable
 */
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            DBTable::AUTH_USERS,
            function (Blueprint $table) {
                $table->id();
                $table->string('username')->unique();
                $table->string('email')->unique();
                $table->json('full_name')->nullable();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->timestamp('first_login_at')->nullable();
                $table->rememberToken();

                $table->integer('created_by')->unsigned()->index()->nullable();
                $table->integer('updated_by')->unsigned()->index()->nullable();
                $table->integer('deleted_by')->unsigned()->index()->nullable();
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('created_by')->references('id')->on(DBTable::AUTH_USERS)->onDelete('cascade');
                $table->foreign('updated_by')->references('id')->on(DBTable::AUTH_USERS)->onDelete('cascade');
                $table->foreign('deleted_by')->references('id')->on(DBTable::AUTH_USERS)->onDelete('cascade');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(DBTable::AUTH_USERS);
    }
}

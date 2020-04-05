<?php

use App\Constants\DBTable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateTelescopeEntriesTable
 */
class CreateTelescopeEntriesTable extends Migration
{
    /**
     * The database schema.
     *
     * @var Builder
     */
    protected $schema;

    /**
     * Create a new migration instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->schema = Schema::connection($this->getConnection());
    }

    /**
     * Get the migration connection name.
     *
     * @return string|null
     */
    public function getConnection()
    {
        return config('telescope.storage.database.connection');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create(
            DBTable::TELESCOPE_ENTRIES,
            function (Blueprint $table) {
                $table->bigIncrements('sequence');
                $table->uuid('uuid');
                $table->uuid('batch_id');
                $table->string('family_hash')->nullable()->index();
                $table->boolean('should_display_on_index')->default(true);
                $table->string('type', 20);
                $table->longText('content');
                $table->dateTime('created_at')->nullable();

                $table->unique('uuid');
                $table->index('batch_id');
                $table->index(['type', 'should_display_on_index']);
            }
        );

        $this->schema->create(
            DBTable::TELESCOPE_ENTRIES_TAGS,
            function (Blueprint $table) {
                $table->uuid('entry_uuid');
                $table->string('tag');

                $table->index(['entry_uuid', 'tag']);
                $table->index('tag');

                $table->foreign('entry_uuid')->references('uuid')->on(DBTable::TELESCOPE_ENTRIES)->onDelete('cascade');
            }
        );

        $this->schema->create(
            DBTable::TELESCOPE_MONITORING,
            function (Blueprint $table) {
                $table->string('tag');
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
        $this->schema->dropIfExists(DBTable::TELESCOPE_ENTRIES_TAGS);
        $this->schema->dropIfExists(DBTable::TELESCOPE_ENTRIES);
        $this->schema->dropIfExists(DBTable::TELESCOPE_MONITORING);
    }
}

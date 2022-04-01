<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'roles';

    /**
     * Run the migrations.
     * @table user_groups
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary();
            $table->string('name', 50)->nullable()->default(null);
            $table->string('status', 10)->nullable()->default(null);
            $table->string('desc', 100)->nullable()->default(null);
            $table->uuid('created_by')->nullable()->default(null);
            $table->uuid('updated_by')->nullable()->default(null);
            $table->nullableTimestamps();

            $table->index(["id"], 'roles__id');
            $table->index(["name"], 'roles__name');
            $table->index(["status"], 'roles__status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}

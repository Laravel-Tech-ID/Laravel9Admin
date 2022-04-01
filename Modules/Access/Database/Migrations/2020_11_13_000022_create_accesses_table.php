<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'accesses';

    /**
     * Run the migrations.
     * @table user_accesses
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary();
            $table->string('name')->nullable()->default(null);
            $table->string('guard_name')->nullable()->default(null);
            $table->string('status', 10)->nullable()->default(null);
            $table->string('desc')->nullable()->default(null);
            $table->uuid('created_by')->nullable()->default(null);
            $table->uuid('updated_by')->nullable()->default(null);
            $table->nullableTimestamps();

            $table->index(["id"], 'accesses__id');
            $table->index(["name"], 'accesses__name');
            $table->index(["guard_name"], 'accesses__guard_name');
            $table->index(["status"], 'accesses__status');
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

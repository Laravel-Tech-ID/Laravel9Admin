<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'users';

    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary();
            $table->string('code', 20)->nullable()->default(null);
            $table->string('name', 50)->nullable()->default(null);
            $table->string('phone', 15)->nullable()->default(null);
            $table->string('email', 50)->nullable()->default(null);
            $table->string('api_token')->nullable()->default(null);
            $table->timestamp('email_verified_at')->nullable()->default(null);
            $table->string('password', 100)->nullable()->default(null);
            $table->string('status', 10)->nullable()->default(null);
            $table->string('picture', 200)->nullable()->default(null);
            $table->string('blocked', 3)->nullable()->default(0);
            $table->string('blocked_reason')->nullable()->default('');
            $table->rememberToken();
            $table->uuid('created_by')->nullable()->default(null);
            $table->uuid('updated_by')->nullable()->default(null);
            $table->nullableTimestamps();

            $table->index(["id"], 'users__id');
            $table->index(["code"], 'users__code');
            $table->index(["name"], 'users__name');
            $table->index(["phone"], 'users__phone');
            $table->index(["email"], 'users__email');
            $table->index(["api_token"], 'users__api_token');
            $table->index(["status"], 'users__status');
            $table->index(["blocked"], 'users__blocked');
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

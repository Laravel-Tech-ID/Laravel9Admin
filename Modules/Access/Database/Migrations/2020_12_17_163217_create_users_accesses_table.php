<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_accesses', function (Blueprint $table) {
            $table->uuid('user_id')->nullable()->default(null);
            $table->uuid('access_id')->nullable()->default(null);
            $table->uuid('created_by')->nullable()->default(null);
            $table->timeStamp('created_at')->nullable()->default(null);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('access_id')->references('id')->on('accesses')->onDelete('cascade');

            $table->index(["user_id"], 'users_accesses__user_id');
            $table->index(["access_id"], 'users_accesses__access_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_accesses');
    }
}

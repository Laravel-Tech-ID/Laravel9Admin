<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('initial',255)->nullable();
            $table->string('name',255)->nullable();
            $table->longText('description')->nullable();
            $table->string('icon', 255)->nullable()->default(null);
            $table->string('logo',255)->nullable();
            $table->string('login_image',255)->nullable();
            $table->string('phone',255)->nullable();
            $table->string('address',255)->nullable();
            $table->string('email',255)->nullable();
            $table->string('facebook',255)->nullable();
            $table->string('twitter',255)->nullable();
            $table->string('google',255)->nullable();
            $table->string('instagram',255)->nullable();
            $table->string('copyright',255)->nullable();
            $table->string('maps_key',255)->nullable();
            $table->string('latitude',255)->nullable();
            $table->string('longitude',255)->nullable();
            $table->text('api_key')->nullable();
            $table->char('created_by', 36)->nullable()->default(null);
            $table->char('updated_by', 36)->nullable()->default(null);
            $table->nullableTimestamps();

            $table->index(["id"], 'settings__id');
            $table->index(["initial"], 'settings__initial');
            $table->index(["name"], 'settings__name');
            $table->index(["icon"], 'settings__icon');
            $table->index(["logo"], 'settings__logo');
            $table->index(["login_image"], 'settings__login_image');
            $table->index(["phone"], 'settings__phone');
            $table->index(["email"], 'settings__setting_email');
            $table->index(["facebook"], 'settings__facebook');
            $table->index(["twitter"], 'settings__twitter');
            $table->index(["google"], 'settings__google');
            $table->index(["instagram"], 'settings__instagram');
            $table->index(["copyright"], 'settings__copyright');
            $table->index(["maps_key"], 'settings__maps_key');
            $table->index(["latitude"], 'settings__latitude');
            $table->index(["longitude"], 'settings__longitude');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}

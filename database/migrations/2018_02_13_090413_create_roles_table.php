<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('access_level');
            $table->boolean('active')->default('1');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('role_id')
                ->nullable()
                ->default('1')
                ->references('id')->on('roles')
                ->onDelete('set null')
                ->after('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role_id');
        });
    }
}

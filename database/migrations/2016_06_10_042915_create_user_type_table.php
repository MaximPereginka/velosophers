<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role');
            $table->string('name');
            $table->timestamps();

        });

        /*
         * Initial values
         */
        DB::insert("
            INSERT INTO `user_type`
            (`name`, `role`)
            VALUES ('Подписчик', 'subscriber'), ('Автор', 'author'), ('Модератор', 'moderator'), ('Администратор', 'admin'), ('Автор-модератор', 'author-moderator')
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_type');
    }
}

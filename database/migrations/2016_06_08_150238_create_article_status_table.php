<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        /*
         * Initial values
         */
        DB::insert("
            INSERT INTO `article_status`
            (`name`)
            VALUES ('Не опубликована'), ('Опубликована'), ('Ожидает модерации'), ('Отклонена'), ('В корзине')
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('article_status');
    }
}

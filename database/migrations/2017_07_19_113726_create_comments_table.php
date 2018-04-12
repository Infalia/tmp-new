<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('parent_id')->nullable();
            $table->integer('initiative_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('user_fullname', 100);
            $table->text('body');
            $table->foreign('initiative_id')->references('id')->on('initiatives')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}

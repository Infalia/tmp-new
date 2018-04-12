<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitiativeImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('initiative_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('initiative_id')->unsigned();
            $table->string('name', 255);
            $table->string('url', 255);
            $table->string('size', 255);
            $table->foreign('initiative_id')->references('id')->on('initiatives')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('initiative_images');
    }
}

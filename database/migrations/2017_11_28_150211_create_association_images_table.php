<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssociationImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('association_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('association_id')->unsigned();
            $table->string('name', 255);
            $table->string('url', 255);
            $table->string('size', 255);
            $table->foreign('association_id')->references('id')->on('associations')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('association_images');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitiativeTypeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('initiative_type_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('initiative_type_id')->unsigned();
            $table->string('name');
            $table->string('locale', 10)->index();
            $table->unique(['initiative_type_id', 'locale']);
            $table->foreign('initiative_type_id')->references('id')->on('initiative_types')->onDelete('cascade');
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
        Schema::dropIfExists('initiative_type_translations');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitiativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('initiatives', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('initiative_type_id');
            $table->integer('user_id');
            $table->string('title', 255);
            $table->text('description');
            $table->decimal('latitude', 20, 18);
            $table->decimal('longitude', 21, 18);
            $table->string('address', 255)->nullable();
            $table->text('input_map_data');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('is_published');
            $table->foreign('initiative_type_id')->references('id')->on('initiative_types');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('initiatives');
    }
}

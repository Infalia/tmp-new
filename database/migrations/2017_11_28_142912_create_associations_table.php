<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssociationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->text('description');
            $table->decimal('latitude', 20, 18);
            $table->decimal('longitude', 21, 18);
            $table->string('address', 255)->nullable();
            $table->text('input_map_data');
            $table->string('phone_1', 20);
            $table->string('phone_2', 20)->nullable();
            $table->string('website', 70)->nullable();
            $table->string('email', 70);
            $table->integer('is_published');
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
        Schema::dropIfExists('associations');
    }
}

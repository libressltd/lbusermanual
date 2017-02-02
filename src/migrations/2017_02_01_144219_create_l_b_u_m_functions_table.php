<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLBUMFunctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LBUM_functions', function (Blueprint $table) {
            $table->char('id', 32);
            $table->primary('id');
            
            $table->char('document_id', 32)->nullable();
            $table->char('parent_id', 32)->nullable();

            $table->text('name_vi')->nullable();
            $table->text('name_en')->nullable();

            $table->text('description_vi')->nullable();
            $table->text('description_en')->nullable();

            $table->char('image_vi_id', 32)->nullable();
            $table->char('image_en_id', 32)->nullable();

            $table->integer('order_number')->default(0);

            $table->char('created_by', 32)->nullable();
            $table->char('updated_by', 32)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('LBUM_functions');
    }
}

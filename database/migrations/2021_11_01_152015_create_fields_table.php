<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if(Schema::hasTable('fields')) return;
        Schema::create('fields', function (Blueprint $table) {
            $table->bigIncrements('FieldID')->index();
			$table->bigInteger('CategoryID')->unsigned();
			$table->string('FieldTitle',255);
			$table->dateTime('CreatedDate')->useCurrent();
        });

        Schema::table('fields', function($table) {
           $table->foreign('CategoryID')->references('CategoryID')->on('categories')->onUpdate('cascade')->onDelete('cascade');
        });
		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fields');
    }
}

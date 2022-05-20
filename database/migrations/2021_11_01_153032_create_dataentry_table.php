<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataentryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if(Schema::hasTable('dataentry')) return;
        Schema::create('dataentry', function (Blueprint $table) {
            $table->bigIncrements('DataId')->index();
            $table->bigInteger('PharmacyID')->unsigned();
            $table->bigInteger('CategoryID')->unsigned();
            $table->bigInteger('FieldID')->unsigned();
			$table->integer('SubmittedValue');
			$table->date('InsertedDate');
            $table->dateTime('SubmittedDate')->useCurrent();
        });

        Schema::table('dataentry', function($table) {
           $table->foreign('PharmacyID')->references('PharmacyID')->on('pharmacies')->onUpdate('cascade')->onDelete('cascade');
           $table->foreign('CategoryID')->references('CategoryID')->on('categories')->onUpdate('cascade')->onDelete('cascade');
           $table->foreign('FieldID')->references('FieldID')->on('fields')->onUpdate('cascade')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dataentry');
    }
}

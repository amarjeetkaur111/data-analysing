<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if(Schema::hasTable('categories')) return;
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('CategoryID')->index();
			$table->string('CategoryName',255);
			$table->integer('EnableStatus')->default('1');
			$table->dateTime('CreatedDate')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}

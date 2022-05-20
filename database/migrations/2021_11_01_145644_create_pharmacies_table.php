<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmaciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if(Schema::hasTable('pharmacies')) return;
        Schema::create('pharmacies', function (Blueprint $table) {
            $table->bigIncrements('PharmacyID')->index();
			$table->string('PharmacyName',255);
			$table->text('PharmacyAddress');
			$table->string('PhoneNumber',255);
			$table->string('ManagerName',255);	
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
        Schema::dropIfExists('pharmacies');
    }
}

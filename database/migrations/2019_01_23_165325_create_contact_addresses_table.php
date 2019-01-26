<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_addresses', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('contact_id');
            $table->foreign('contact_id')->references('id')->on('contacts');

            $table->string('street');
            $table->string('city');
            $table->string('province');
            $table->string('zip');
            $table->string('country_code');

            $table->smallInteger('default')->default(0);

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
        Schema::dropIfExists('contact_addresses');
    }
}

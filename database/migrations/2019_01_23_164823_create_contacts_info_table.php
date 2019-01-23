<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts_info', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('contact_id');
            $table->foreign('contact_id')->references('id')->on('contacts');

            $table->enum('type', ['email', 'mobile', 'tel', 'fax']);

            $table->string('content');

            $table->mediumText('notes');

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
        Schema::dropIfExists('contacts_info');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_menu_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_menu')->references('id')->on('m_menuses');
            $table->string('name');
            $table->string('url')->nullable();
            $table->timestamps();
            $table->index('id_menu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_menu_details');
    }
};

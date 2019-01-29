<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id');
            $table->enum('type', ['staging', 'production']);
            $table->string('url')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('directory')->nullable();
            $table->string('ssh_user')->nullable();
            $table->string('ssh_key')->nullable();
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
        Schema::dropIfExists('servers');
    }
}

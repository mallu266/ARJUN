<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoggerTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('logger', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('description');
            $table->string('userType');
            $table->string('guard')->default('web');
            $table->integer('userId')->nullable();
            $table->longText('route')->nullable();
            $table->ipAddress('ipAddress')->nullable();
            $table->text('userAgent')->nullable();
            $table->string('locale')->nullable();
            $table->longText('referer')->nullable();
            $table->string('methodType')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('logtable');
    }

}

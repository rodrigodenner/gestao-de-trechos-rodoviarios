<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUfsTable extends Migration
{
  public function up()
  {
    Schema::create('ufs', function (Blueprint $table) {
      $table->id();
      $table->string('UF');
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('ufs');
  }
}

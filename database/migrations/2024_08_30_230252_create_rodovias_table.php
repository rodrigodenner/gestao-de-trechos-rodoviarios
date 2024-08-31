<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRodoviasTable extends Migration
{
  public function up()
  {
    Schema::create('rodovias', function (Blueprint $table) {
      $table->id();
      $table->foreignId('uf_id')->constrained('ufs')->onDelete('cascade');
      $table->string('rodovia');
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('rodovias');
  }
}

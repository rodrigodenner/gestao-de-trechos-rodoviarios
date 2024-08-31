<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UF extends Model
{
  protected $table = 'ufs';

  protected $fillable = ['UF'];

  public function rodovias()
  {
    return $this->hasMany(Rodovia::class);
  }

  public function trechos()
  {
    return $this->hasMany(Trecho::class);
  }
}

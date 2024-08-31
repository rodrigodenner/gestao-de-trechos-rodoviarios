<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rodovia extends Model
{
  protected $table = 'rodovias';

  protected $fillable = ['uf_id', 'rodovia'];

  public function uf()
  {
    return $this->belongsTo(UF::class);
  }

  public function trechos()
  {
    return $this->hasMany(Trecho::class);
  }
}


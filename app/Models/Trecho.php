<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trecho extends Model
{
  protected $table = 'trechos';

  protected $fillable = [
    'data_referencia', 'uf_id', 'rodovia_id',
    'kmInicial', 'kmFinal', 'geo'
  ];

  public function uf()
  {
    return $this->belongsTo(UF::class);
  }

  public function rodovia()
  {
    return $this->belongsTo(Rodovia::class);
  }
}



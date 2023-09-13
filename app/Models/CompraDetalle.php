<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraDetalle extends Model
{
    use HasFactory;
    protected $table = 'compra_detalles';
    public function pintura()
    {
    	return $this->belongsTo(Pintura::class);
    }
    
    public $timestamps = false;
}

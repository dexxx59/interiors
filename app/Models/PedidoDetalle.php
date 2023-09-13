<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoDetalle extends Model
{
    use HasFactory;
    public function pintura()
    {
    	// CartDetail N --------- 1 Product
    	return $this->belongsTo(Pintura::class);
    }
}

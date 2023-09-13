<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    public function detalles()
    {
    	return $this->hasMany(PedidoDetalle::class);
    }

    public function getTotalAttribute(){
        $ConDescuento = 0;
        $precio = 0;
    	$total =0;
    	foreach ($this->detalles as $detail) {
            if ($detail->pintura->descuento > 0) {
                
                $div = $detail->pintura->descuento / 100;
                $ConDescuento = $div * $detail->pintura->precioUnit;
                $precio = $detail->pintura->precioUnit - $ConDescuento;

    		    $total += $detail->cantidad * $precio;
            } else {
    		    $total += $detail->cantidad * $detail->pintura->precioUnit;	
            }
    	}
    	return $total;

    }
    
    public function cliente(){
        return $this->belongsTo(User::class, 'user_id');
    }

}

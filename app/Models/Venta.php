<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';

    protected $fillable = ['user_id', 'cliente_id', 'codigo', 'total', 'fecha_venta', 'estado'];

    //Es el usuario que hace el registro
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    //Es el usuario que hace el registro
    public function cliente(){
        return $this->belongsTo(User::class, 'cliente_id');
    }
}

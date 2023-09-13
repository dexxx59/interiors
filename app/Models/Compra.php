<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $table = 'compras';

    protected $fillable = ['user_id', 'codigo', 'total', 'fecha_compra', 'estado'];

    //Es el usuario que hace el registro
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}

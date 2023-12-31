<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','description'];

    public static $rules = [
        'nombre' => 'required|min:3',
        'description' => 'max:250'
    ];

    public function pinturas(){
        return $this->hasMany(Pintura::class);
    }

    public function getFeaturedImageUrlAttribute(){
      if($this->image){
          return '/clients/images/categories/' . $this->image;
      }else{

        $firstProduct = $this->pinturas()->first();    
        if($firstProduct)   
            return $firstProduct->featured_image_url;
          else
            return '/clients/images/default.png';
      }
    }
}

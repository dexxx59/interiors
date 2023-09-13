<?php

namespace App\Http\Controllers;

use App\Models\Pintura;
use Illuminate\Http\Request;

class PinturaController extends Controller
{
    public function show($id) {
        $product = Pintura::find($id);
     $images = $product->images;

     $imagesLeft = collect();
     $imagesRight = collect();
     foreach ($images as $key => $image) {
       if($key%2 == 0)
             $imagesLeft->push($image);
       else
             $imagesRight->push($image);
     }
          return view('prendas.show')->with(compact('product', 'imagesLeft', 'imagesRight'));
  }
}

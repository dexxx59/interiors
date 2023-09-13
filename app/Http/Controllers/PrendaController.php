<?php

namespace App\Http\Controllers;

use App\Models\Pintura;
use App\Models\Prenda;
use Illuminate\Http\Request;

class PrendaController extends Controller
{
      public function show($id) {
   	      $product = Pintura::find($id);
   	      return view('prendas.show')->with(compact('product'));
      }
}

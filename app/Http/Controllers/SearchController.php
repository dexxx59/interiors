<?php

namespace App\Http\Controllers;

use App\Models\Pintura;
use App\Models\Prenda;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function show(Request $request)
    {
    		$query = $request->input('query');
    		$products = Pintura::where('nombre', 'like', "%$query%")->paginate(5);

    		if($products->count() == 1){
    			$id = $products->first()->id;
    			return redirect("/products/$id");
    		}
    		return view('search.show')->with(compact('products', 'query'));
    }

    public function data()
    {
    	$products = Pintura::pluck('nombre');
    	return $products;
    }
}

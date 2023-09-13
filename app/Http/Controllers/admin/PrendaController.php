<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Color;
use App\Models\Marca;
use App\Models\PedidoDetalle;
use App\Models\Pintura;
use App\Models\Prenda;
use App\Models\PrendaImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PrendaController extends Controller
{
    private $validar = [
        'nombre' => 'required',
        'stock' => 'required | numeric | min:5',
        'precioUnit' => 'required',
        'description' => 'required',
        'color_id' => 'required',
        'marca_id' => 'required',
        'categoria_id' => 'required',
    ];

    public function index(Request $res) {
    	$query = $res->input('query');
        $prendas = Pintura::where('nombre', 'like', "%$query%")->paginate(10);
        return view('admin.products.index')->with(compact('prendas'));
    }

    public function create() {
        $marcas = Marca::orderBy('nombre')->get();
        $colors = Color::all();
        $categories = Categoria::orderBy('nombre')->get();
        return view('admin.products.create')->with(compact('categories', 'marcas', 'colors'));
    }

    public function store(Request $request){

        $request->validate($this->validar);
        $prenda = new Pintura();
        $prenda->categoria_id = $request->categoria_id;
        $prenda->marca_id = $request->marca_id;
        $prenda->color_id = $request->color_id;
        $prenda->nombre = $request->nombre;
        $prenda->stock = $request->stock;
        $prenda->precioUnit = $request->precioUnit;
        $prenda->description = $request->description;
        $prenda->image = $request->image;
        /*if($request->hasFile('image')) {    
            $file = $request->file('image');
            $path = public_path() . '/clients/images/products';
            $fileName = uniqid() . '-' .$file->getClientOriginalName();
            $moved = $file->move($path, $fileName);
            if ($moved) 
            {
                $prenda->image = $fileName;
                $prenda->save();
            }
        }*/
        $prenda->save();
        
    	$msg = 'La Pintura se agrego exitosamente!';
        return redirect('admin/products')->with(compact('msg'));
    }

    public function edit($id) {
        
        $categories = Categoria::orderBy('nombre')->get();
        $marcas = marca::all();
        $colors = Color::all();
        $prendaEdit = Pintura::find($id);
        return view('admin.products.edit')->with(compact('prendaEdit', 'categories', 'marcas', 'colors'));
    }

    public function update(Request $request, $id) {
        $request->validate($this->validar);
        $prenda = Pintura::find($id);
        $prenda->categoria_id = $request->categoria_id;
        $prenda->marca_id = $request->marca_id;
        $prenda->color_id = $request->color_id;
        $prenda->nombre = $request->nombre;
        $prenda->stock = $request->stock;
        $prenda->precioUnit = $request->precioUnit;
        $prenda->description = $request->description;
        $prenda->image = 'image';
        $prenda->save();
    	$msg = 'La actualizo exitosamente!';
        return redirect('admin/products')->with(compact('msg'));
    }
    public function destroy($id) {
        PedidoDetalle::where('pintura_id', $id)->delete();
   		$product = Pintura::find($id);
   		$product->delete();
   		
        Session::flash('msg', 'Se eliminó el producto y las imágenes asociadas');
   		return back();
   }
}

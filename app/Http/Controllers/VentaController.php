<?php

namespace App\Http\Controllers;

use App\Models\Pintura;
use App\Models\User;
use App\Models\Venta;
use App\Models\VentaDetalle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VentaController extends Controller
{
    
    public function index(Request $request) {
		$sql = trim($request->get('buscarTexto'));
		$ventas = Venta::where('fecha_venta', 'like', "%$sql%")->paginate(5);
        return view('admin.ventas.index', ['ventas' => $ventas, 'buscarTexto' => $sql]);
	}

	public function create(Request $request)
	{
		$prendas = Pintura::orderBy('nombre')->get();
		$cliente = User::where('admin', false)->get();
		return view('admin.ventas.create', ['productos' => $prendas, 'cliente' => $cliente]);
	}

	
    public function mostrar($id)
    {
        $mostrarPintura = Pintura::find($id);
        return response()->json([
            'status' => 200,
            'mostrarPintura' => $mostrarPintura,
        ]);
    }
	
	public function store(Request $request)
	{
		//try{
			//DB::beginTransaction();

			$mytime = Carbon::now('America/Mexico_City');
			$venta = new Venta();
			$numero_aleatorio = rand(1,100);
			$venta->user_id = Auth::user()->id;
			$venta->cliente_id = $request->id_cliente;
			$venta->codigo = $numero_aleatorio;
			$venta->fecha_venta = $mytime->toDateString();
			$venta->total = $request->total_pagar;
			$venta->estado = 'Registrado';

			$venta->save();
			$pintura_id = $request->id_producto;
			$cantidad = $request->cantidad;
			$precio = $request->precio_venta;

			$cont = 0;

			while($cont < count($pintura_id))
			{
				$detalle = new ventaDetalle();
				$productoActualizado = Pintura::find($pintura_id[$cont]);
				
				$detalle->venta_id = $venta->id;
				$detalle->pintura_id = $pintura_id[$cont];
				$detalle->cantidad = $cantidad[$cont];
				$detalle->precio = $precio[$cont];
				$detalle->save();
				$cont = $cont + 1;
				
				$productoActualizado->stock -= $detalle->cantidad;
				$productoActualizado->saveOrFail();
			}
			//DB::commit();
		/*}catch(Exception $e){
			DB::rollBack();
		}*/
		
		return redirect('admin/venta');
		//return Redirect::to('admin.venta');
	}

	public function show($id) {
		$venta = Venta::find($id);
		$detalles = VentaDetalle::where('venta_id', $id)->get();
		return view('admin.ventas.show', ['venta' => $venta, 'detalles' => $detalles]);
	}

	public function destroy($id) {
		$venta = Venta::findOrFail($id);
		$venta->estado = 'Anulado';
		$venta->save();
		return redirect('admin/venta');
	}
}

<?php

namespace App\Http\Controllers;

use App\Models\PedidoDetalle;
use App\Models\Pintura;
use App\Models\Prenda;
use Illuminate\Http\Request;

class CartDetailController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function store(Request $request) {
    	$cartDetail = new PedidoDetalle();
		$productoActualizado = Pintura::find($request->prenda_id);
		if ($request->cantidad > $productoActualizado->stock) {
			$msgError = "Prenda agotada";
			return back()->with(compact('msgError'));
		}
		else {
			$cartDetail->pedido_id = auth()->user()->cart->id;
			$cartDetail->pintura_id= $request->prenda_id;
			$cartDetail->cantidad = $request->cantidad;
			if ($productoActualizado->descuento != 0){
				$cartDetail->conDescuento = $request->cantidad * ($productoActualizado->precioUnit - $productoActualizado->precioUnit * $productoActualizado->descuento /100);
			} else {
                $cartDetail->subTotal = $request->cantidad * $productoActualizado->precioUnit;
            }
			$cartDetail->save();
			$productoActualizado->stock -= $cartDetail->cantidad;
			$productoActualizado->saveOrFail();

			$msg ="Producto agregado al carrito";
			return back()->with(compact('msg'));
		}
    }

    public function destroy(Request $request) {
    	$cartDetail =  PedidoDetalle::find($request->cart_detail_id);  
        $productoActualizado = Prenda::find($cartDetail->prenda_id);
        $productoActualizado->stock += $cartDetail->cantidad;
        $productoActualizado->saveOrFail();
    	if($cartDetail->pedido_id == auth()->user()->cart->id) 	
    		$cartDetail->delete();
    	$msg ="Producto eliminado del carrito";
    	return back()->with(compact('msg'));

    }
    public function agregarAlCarrito($pedidoId, $prendaId, $cantidad)
    {
        // Verificar si el pedido existe o crear uno nuevo si no existe
        $pedido = Pedido::findOrNew($pedidoId);

        // Verificar si la prenda ya está en el carrito
        $detalle = $pedido->detalles()->where('prenda_id', $prendaId)->first();

        if ($detalle) {
            // Si la prenda ya está en el carrito, actualizar la cantidad
            $detalle->cantidad += $cantidad;
            $detalle->save();
        } else {
            // Si la prenda no está en el carrito, agregar un nuevo detalle
            $pedido->detalles()->create([
                'prenda_id' => $prendaId,
                'cantidad' => $cantidad,
            ]);
        }

        // Puedes devolver el carrito actualizado o cualquier otra información necesaria
        return $pedido;
    }

    public function eliminarDelCarrito($detalleId)
    {
        // Encontrar y eliminar el detalle del carrito
        $detalle = PedidoDetalle::find($detalleId);

        if ($detalle) {
            $detalle->delete();
        }

        // Puedes devolver el carrito actualizado o cualquier otra información necesaria
        return $detalle;
    }

    public function obtenerCarrito($pedidoId)
    {
        // Obtener el carrito con detalles y prendas relacionadas
        $carrito = Pedido::with('detalles.prenda')->find($pedidoId);

        return $carrito;
    
   }
    public function mostrarCarrito($pedidoId)
    {
        // Obtener el carrito con detalles y prendas relacionadas
        $carrito = Pedido::with('detalles.prenda')->find($pedidoId);

        return view('carrito.mostrar', compact('carrito'));
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\View\View;

class AdminOrderController extends Controller
{
    /**
     * Display the specified order details.
     */
    public function show(Order $order): View
    {
        $order->load('items.product', 'user');
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string|in:Pendiente,Pagado,Enviado,Entregado,Cancelado',
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.orders.show', $order)->with('success', 'Estado del pedido actualizado correctamente.');
    }
}

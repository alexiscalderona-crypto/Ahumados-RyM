<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    /**
     * Show the checkout form.
     * ES: Mostrar el formulario de Checkout con el resumen del pedido antes de pagar.
     * EN: Show the Checkout form with the order summary before paying.
     */
    public function create(): View
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío.');
        }

        // ES: Calculamos el subtotal de los ítems en sesión
        // EN: Calculate the subtotal of the items in session
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout.index', compact('cart', 'total'));
    }

    /**
     * Process checkout and store the order.
     * ES: Guardar la Orden y sus Productos Relacionados en la Base de Datos.
     * EN: Save the Order and its Related Products in the Database.
     */
    public function store(Request $request): RedirectResponse
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío.');
        }

        // ES: Volvemos a calcular el total antes de guardar por seguridad
        // EN: Re-calculate the total before saving for security
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // ES: 1. Creamos la cabecera del pedido (Order) vinculando el ID del usuario autenticado
        // EN: 1. Create the order header (Order) binding the authenticated user's ID
        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'status' => 'Pendiente',
            'address' => $request->input('address', ''),
            'city' => $request->input('city', ''),
            'zip' => $request->input('zip', ''),
            'phone' => $request->input('phone', ''),
        ]);

        // ES: 2. Recorremos el carrito y guardamos cada ítem individual en la tabla 'order_items'
        // EN: 2. Loop through the cart and save each individual item in the 'order_items' table
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id, // ES: Llave foránea del pedido recién creado / EN: Foreign key of the newly created order
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // ES: 3. Limpiamos el carrito de la sesión tras realizar la compra con éxito
        // EN: 3. Clear the session cart after successfully placing the order
        session()->forget('cart');

        return redirect()->route('orders.index')->with('success', '¡Pedido realizado con éxito!');
    }

    /**
     * Display the user's orders.
     * ES: Listar el historial de pedidos del usuario autenticado.
     * EN: List the order history of the authenticated user.
     */
    public function index(): View
    {
        // ES: Traemos las órdenes del usuario con sus ítems y productos cargados (Eager Loading)
        // EN: Retrieve user orders with their loaded items and products (Eager Loading)
        $orders = Order::where('user_id', Auth::id())->with('items.product')->orderBy('created_at', 'desc')->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Display a specific order.
     * ES: Mostrar el detalle de un pedido específico.
     * EN: Display the details of a specific order.
     */
    public function show(Order $order): View
    {
        // ES: Verificamos por seguridad que el pedido pertenezca al usuario autenticado
        // EN: Verify for security that the order belongs to the authenticated user
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
        
        $order->load('items.product');
        return view('orders.show', compact('order'));
    }
    /**
     * Download the order invoice as PDF.
     */
    public function downloadInvoice(Order $order)
    {
        // Verificar que el pedido pertenezca al usuario o que el usuario sea admin
        if ($order->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $order->load('items.product', 'user');

        $pdf = Pdf::loadView('orders.invoice', compact('order'));
        
        return $pdf->download('Comprobante_Pedido_#' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . '.pdf');
    }
}
?>

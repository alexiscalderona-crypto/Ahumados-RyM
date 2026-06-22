<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Display the shopping cart.
     * ES: Mostrar los productos agregados al carrito (almacenados en la sesión).
     * EN: Display the products added to the cart (stored in session).
     */
    public function index(): View
    {
        // ES: Obtenemos el carrito de la sesión. Si no existe, inicializamos como array vacío []
        // EN: Retrieve the cart from session. If it doesn't exist, initialize as empty array []
        $cart = session()->get('cart', []);
        
        // ES: Limpieza de posibles elementos inválidos por errores previos
        // EN: Clean up any invalid items caused by previous routing bugs
        $cleaned = false;
        foreach ($cart as $key => $item) {
            if (empty($key) || empty($item['id'])) {
                unset($cart[$key]);
                $cleaned = true;
            }
        }
        
        if ($cleaned) {
            session()->put('cart', $cart);
        }

        // ES: Calculamos el gran total sumando el (precio * cantidad) de cada item del carrito
        // EN: Calculate the grand total by summing (price * quantity) for each cart item
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('cart.index', compact('cart', 'total'));
    }

    /**
     * Add a product to the cart.
     * ES: Agregar un producto al carrito (utilizando la sesión).
     * EN: Add a product to the cart (using the session).
     */
    public function store(Request $request, Product $product): RedirectResponse
    {
        $cart = session()->get('cart', []);

        // ES: Si el producto ya está en el carrito, incrementamos la cantidad
        // EN: If the product is already in the cart, increment the quantity
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            // ES: Si es nuevo, lo agregamos al array con sus detalles
            // EN: If it's new, add it to the array with its details
            $cart[$product->id] = [
                "id" => $product->id,
                "title" => $product->title,
                "quantity" => 1,
                "price" => $product->price,
            ];
        }

        // ES: Guardamos la estructura del carrito actualizada de vuelta en la sesión
        // EN: Save the updated cart structure back to the session
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }

    /**
     * Update cart quantities.
     * ES: Actualizar la cantidad de un producto específico en el carrito.
     * EN: Update the quantity of a specific product in the cart.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            
            // ES: Actualizamos la cantidad según lo enviado en la petición
            // EN: Update the quantity according to the request
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Carrito actualizado.');
        }
    }

    /**
     * Remove an item from the cart.
     * ES: Eliminar un producto del carrito.
     * EN: Remove a product from the cart.
     */
    public function destroy($id): RedirectResponse
    {
        if ($id) {
            $cart = session()->get('cart');
            if (isset($cart[$id])) {
                // ES: Eliminamos el elemento usando la clave ID del producto
                // EN: Remove the item using the product ID key
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
            return redirect()->route('cart.index')->with('success', 'Producto eliminado.');
        }
    }
}
?>

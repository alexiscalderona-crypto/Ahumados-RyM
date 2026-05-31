<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     * ES: Listar y paginar todos los productos de la tienda.
     * EN: List and paginate all store products.
     */
    public function index(): View
    {
        // ES: Obtenemos los productos con su categoría relacionada (Eager Loading para optimizar consultas)
        //     y paginamos de 12 en 12.
        // EN: Retrieve products with their related category (Eager Loading to optimize queries)
        //     and paginate them 12 per page.
        $products = Product::with('category')->paginate(12);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     * ES: Mostrar el formulario para registrar un nuevo producto.
     * EN: Show the form for registering a new product.
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created product.
     * ES: Guardar en la base de datos el producto enviado por el formulario.
     * EN: Save the product submitted by the form into the database.
     */
    public function store(Request $request): RedirectResponse
    {
        // ES: Validamos que los datos cumplan con las reglas requeridas antes de guardar
        // EN: Validate that the data complies with the required rules before saving
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image_path' => 'nullable|string',
        ]);
        
        // ES: Asignación masiva (Mass Assignment) para crear el registro directamente
        // EN: Mass Assignment to create the record directly
        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Product created');
    }

    /**
     * Display the specified product.
     * ES: Mostrar la vista detallada de un producto en específico.
     * EN: Show the detailed view of a specific product.
     */
    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     * ES: Mostrar el formulario para editar los datos de un producto.
     * EN: Show the form to edit the data of a product.
     */
    public function edit(Product $product): View
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product.
     * ES: Procesar y guardar la edición del producto.
     * EN: Process and save the product edit.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        // ES: Validación de los datos que van a ser actualizados
        // EN: Validation of the data to be updated
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image_path' => 'nullable|string',
        ]);
        
        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Product updated');
    }

    /**
     * Remove the specified product.
     * ES: Eliminar permanentemente un producto de la base de datos.
     * EN: Permanently remove a product from the database.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted');
    }
}
?>

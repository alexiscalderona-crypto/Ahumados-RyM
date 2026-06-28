<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Claim;
use Illuminate\Support\Facades\Auth;

class ClaimController extends Controller
{
    public function index()
    {
        $claims = Claim::where('user_id', Auth::id())->latest()->get();
        return view('claims.index', compact('claims'));
    }

    public function create()
    {
        return view('claims.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'order_reference' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048', // max 2MB
        ]);

        if (Auth::check()) {
            $validated['user_id'] = Auth::id();
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageData = base64_encode(file_get_contents($file->getRealPath()));
            $validated['image_data'] = 'data:' . $file->getClientMimeType() . ';base64,' . $imageData;
        }

        Claim::create($validated);

        if (Auth::check()) {
            return redirect()->route('claims.index')->with('success', 'Reclamo enviado correctamente. Puedes hacerle seguimiento desde aquí.');
        }

        return redirect()->back()->with('success', 'Mensaje enviado correctamente. Nos pondremos en contacto contigo pronto.');
    }
}

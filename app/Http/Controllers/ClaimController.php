<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Claim;
use Illuminate\Support\Facades\Auth;

class ClaimController extends Controller
{
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
        ]);

        if (Auth::check()) {
            $validated['user_id'] = Auth::id();
        }

        Claim::create($validated);

        return redirect()->back()->with('success', 'Mensaje enviado correctamente. Nos pondremos en contacto contigo pronto.');
    }
}

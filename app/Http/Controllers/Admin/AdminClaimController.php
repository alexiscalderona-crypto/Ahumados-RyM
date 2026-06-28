<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Claim;

class AdminClaimController extends Controller
{
    public function index()
    {
        $claims = Claim::orderBy('created_at', 'desc')->get();
        return view('admin.claims.index', compact('claims'));
    }

    public function resolve(Request $request, Claim $claim)
    {
        $request->validate([
            'admin_reply' => 'required|string',
        ]);

        $claim->update([
            'status' => 'resolved',
            'admin_reply' => $request->admin_reply,
        ]);
        return redirect()->back()->with('success', 'Respuesta enviada y reclamo marcado como resuelto.');
    }
}

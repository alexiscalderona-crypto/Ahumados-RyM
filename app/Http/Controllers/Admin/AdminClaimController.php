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

    public function resolve(Claim $claim)
    {
        $claim->update(['status' => 'resolved']);
        return redirect()->back()->with('success', 'Reclamo marcado como resuelto.');
    }
}

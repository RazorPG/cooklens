<?php

namespace App\Http\Controllers;

use App\Models\Analysis;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $analyses = Analysis::where('user_id', auth()->id())
            ->latest()
            ->take(5)
            ->with('recommendations')
            ->get();

        return view('dashboard', compact('analyses'));
    }
}

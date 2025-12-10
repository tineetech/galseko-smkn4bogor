<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $total_galeri = Galery::count();

        $galeri_menunggu = Galery::where('status', 'menunggu')->count();

        $total_akun = User::count();

        return view('backend.dashboard', compact(
            'total_galeri',
            'galeri_menunggu',
            'total_akun'
        ));
    }
}

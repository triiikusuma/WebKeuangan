<?php

namespace App\Http\Controllers;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $antrianSekarang = Laporan::whereIn('status', ['pending', 'processing'])
            ->orderBy('id', 'asc')
            ->first();
        $totalAntrian = Laporan::whereIn('status', ['pending', 'processing'])->count();
        $antrianKamu = Laporan::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'processing'])
            ->orderBy('id', 'asc')
            ->first();
        $recentReports = Laporan::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'processing'])
            ->orderBy('created_at', 'asc')
            ->take(5)
            ->get();
        return view('user.dashboard', compact('recentReports', 'antrianSekarang', 'totalAntrian', 'antrianKamu'));  // Return the user dashboard view
    }

    public function reportHistory()
    {
        $user = Auth::user();
        $reports = Laporan::where('user_id', $user->id)->get();
        return view('user.historyLaporan', compact('reports'));  // Return the user profile view
    }

    public function viewReport($id)
    {
        $report = Laporan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('user.lihatLaporan', compact('report'));  // Return the user profile view
    }

    public function settings()
    {
        return view('user.settingUser');  // Return the user settings view
    }
}

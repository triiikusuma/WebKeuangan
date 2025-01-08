<?php

// app/Http/Controllers/LaporanController.php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        if ($user->status == 'blacklist') {
            return redirect()->route('dashboard')->with('error', 'Akun anda telah diblacklist');
        }
        return view('user.tambahLaporan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_laporan' => 'required|string|max:255',
            'buktiLaporan' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'keterangan' => 'required|string|max:1000',
        ]);

        $file = $request->file('buktiLaporan');
        $newFileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $filePath = $file->storeAs('laporan_files', $newFileName, 'public'); // Store in 'laporan_files' folder

        Laporan::create([
            'jenisLaporan' => $request->jenis_laporan,
            'buktiLaporan' => $filePath,
            'keterangan' => $request->keterangan,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Laporan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'balasanAdmin' => 'required|string|max:1000',
        ]);

        $report = Laporan::find($id);
        $report->status = 'completed';
        $report->balasanAdmin = $request->balasanAdmin;
        $report->save();

        return redirect()->route('admin.dashboard')->with('success', 'Laporan berhasil diupdate');
    }

    public function index(Request $request)
    {
        $search = $request->get('search'); // Get search query from input field
        
        $user = Auth::user();
        if ($user->role == 'admin') {
            $reports = Laporan::search($search)->get(); // Call the search scope
            return view('admin.searchLaporan', compact('reports', 'search')); // Return the results to the view
        }
    
        $reports = Laporan::where('user_id', $user->id)->search($search)->get(); // Call the search scope
    
        return view('user.searchLaporan', compact('reports', 'search')); // Return the results to the view
    }
}

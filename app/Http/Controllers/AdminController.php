<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $antrianSekarang = Laporan::whereIn('status', ['pending', 'processing'])
            ->orderBy('id', 'asc')
            ->first();
        $totalAntrian = Laporan::whereIn('status', ['pending', 'processing'])->count();
        $usersCount = User::where('role', 'user')->count();
        $laporanCount = Laporan::count();
        $recentReports = Laporan::whereIn('status', ['pending', 'processing'])->take(5)->get();
        return view('admin.dashboard', compact('recentReports', 'usersCount', 'laporanCount', 'antrianSekarang', 'totalAntrian'));  // Return the admin dashboard view
    }

    public function manageUser()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.dataMahasiswa', compact('users'));
    }

    public function addUser()
    {
        return view('admin.tambahMahasiswa');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'nik' => ['required', 'numeric', 'digits:9', 'unique:'.User::class],
            'phone' => ['required', 'numeric', 'digits_between:10,15', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'status' => 'active',
        ]);
        return redirect()->route('admin.manageUser')->with('success', 'User berhasil ditambahkan');
    }

    public function blacklistUser($id)
    {
        $user = User::find($id);
        $user->status = 'blacklist';
        $user->save();
        return redirect()->back()->with('success', 'Status user berhasil diubah');
    }

    public function activeUser($id)
    {
        $user = User::find($id);
        $user->status = 'active';
        $user->save();
        return redirect()->back()->with('success', 'Status user berhasil diubah');
    }

    public function nonactiveUser($id)
    {
        $user = User::find($id);
        $user->status = 'inactive';
        $user->save();
        return redirect()->back()->with('success', 'Status user berhasil diubah');
    }

    public function manageAdmin()
    {
        $admins = User::where('role', 'admin')->get();
        return view('admin.dataAdmin', compact('admins'));  // Return the manage admin view
    }

    public function addAdmin()
    {
        return view('admin.tambahAdmin');  // Return the add admin view
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'nik' => ['required', 'numeric', 'digits:9', 'unique:'.User::class],
            'phone' => ['required', 'numeric', 'digits_between:10,15', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'status' => 'active',
        ]);
        return redirect()->route('admin.manageAdmin')->with('success', 'Admin berhasil ditambahkan');
    }

    public function processReport($id)
    {
        $report = Laporan::find($id);
        if($report->status == 'pending'){
            $report->status = 'processing';    
        }
        $report->save();
        return view('admin.laporanMahasiswa', compact('report'));  // Return the manage user view
    }

    public function reportList()
    {
        $reports = Laporan::all();
        return view('admin.historyLaporan', compact('reports'));  // Return the manage user view
    }

    public function settings()
    {
        return view('admin.settingAdmin');
    }

    public function editDataUser($id)
    {
        $user = User::find($id);
        return view('admin.editDataUser', compact('user'));
    }
}

@extends('layouts.appUser')

@section('contentUser')
@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#fff',
                iconColor: '#3085d6',
                height: '100px',
                padding: '10px',
            });
        });
    </script>
@endif
<div class="p-6">
    <div class="flex justify-between items-center mt-2">
        <h3 class="text-2xl sm:text-3xl font-semibold">History Laporan</h3>
        <a href="{{ route('user.tambahLaporan') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Buat Laporan</a>
    </div>

    <div class="mt-8 bg-white p-6 rounded-lg shadow-md flex items-center justify-center">
        <div class="w-full overflow-x-auto">
            <table class="mt-4 w-full text-sm">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-center">NO</th>
                        <th class="px-4 py-2 text-center">No Laporan</th>
                        <th class="px-4 py-2 text-center">Nama</th>
                        <th class="px-4 py-2 text-center">NIM</th>
                        <th class="px-4 py-2 text-center">Tipe Laporan</th>
                        <th class="px-4 py-2 text-center">Bukti Transaksi</th>
                        <th class="px-4 py-2 text-center">Keterangan</th>
                        <th class="px-4 py-2 text-center">Status</th>
                        <th class="px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                    <tr class="h-24">
                        <td class="px-4 py-2 border-t border-b text-center">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border-t border-b text-center">{{ $report->id }}</td>
                        <td class="px-4 py-2 border-t border-b text-center">{{ $report->user->name }}</td>
                        <td class="px-4 py-2 border-t border-b text-center">{{ $report->user->nik }}</td>
                    <td class="px-4 py-2 border-t border-b text-center">{{$report->jenisLaporan}}</td>
                        <td class="px-4 py-2 border-t border-b text-center">                                    <a href="{{ asset('storage/' . $report->buktiLaporan) }}" target="_blank">
                            <img src="{{ asset('storage/' . $report->buktiLaporan) }}" alt="bukti transaksi" style="max-width: 100px; max-height: 100px; display: block; margin: 0 auto;">
                        </a></td>
                        <td class="px-4 py-2 border-t border-b text-center">{{ \Illuminate\Support\Str::words($report->keterangan, 5) }}</td>
                        <td class="px-4 py-2 border-t border-b text-center">
                            @if ($report->status == 'pending')
                                <span class="bg-red-500 bg-opacity-20 text-red-700 px-4 py-2 rounded-md font-bold">Pending</span>
                            @elseif ($report->status == 'processing')
                                <span class="bg-blue-500 bg-opacity-20 text-blue-700 px-4 py-2 rounded-md font-bold">Processing</span>
                            @elseif ($report->status == 'completed')
                                <span class="bg-green-500 bg-opacity-20 text-green-700 px-4 py-2 rounded-md font-bold">Completed</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border-t border-b text-center">
                            <a href="{{ route('user.lihatLaporan', $report->id) }}" class="bg-green-500 text-white px-4 py-2 rounded-md">Lihat</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

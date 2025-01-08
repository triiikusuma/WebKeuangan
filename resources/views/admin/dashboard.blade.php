@extends ('layouts.appAdmin')

@section('contentAdmin')
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
        <h2 class="text-3xl font-semibold text-gray-700">Dashboard</h2>
        <div class="mt-6 flex flex-wrap gap-6">
            <div class="bg-white p-4 rounded-lg shadow-md sm:w-[262px] w-full flex justify-between sm:justify-around items-start">
                <div>
                    <h3 class="text-lg text-[rgba(0,0,0,0.6)] font-semibold">Antrian Sekarang</h3>
                    <p class="text-2xl font-bold mt-2">{{$antrianSekarang ? $antrianSekarang->id : "-"}}</p>
                </div>
                <div style="background-color: rgba(130, 128, 255, 0.3);" class="w-14 h-14 rounded-2xl flex items-center justify-center">
                    <span class="iconify text-3xl text-[#3D42DF]" data-icon="ion:people" data-inline="false" style="transform: scaleX(-1);"></span>
                </div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md sm:w-[262px] w-full flex justify-between sm:justify-around items-start">
                <div>
                    <h3 class="text-lg text-[rgba(0,0,0,0.6)] font-semibold">Antrian Selanjutnya</h3>
                    <p class="text-2xl font-bold mt-2">
                        @if ($totalAntrian == 0)
                            -
                        @elseif ($totalAntrian == 1)
                            {{$antrianSekarang ? $antrianSekarang->id : "-"}}
                        @else
                            {{$antrianSekarang ? $antrianSekarang->id + 1 : "-"}}
                        @endif
                    </p>
                </div>
                <div style="background-color: rgba(254, 197, 61, 0.3);" class="w-14 h-14 rounded-2xl flex items-center justify-center">
                    <span class="iconify text-3xl text-[#FEC53D]" data-icon="ri:box-3-fill" data-inline="false"></span>
                </div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md sm:w-[262px] w-full flex justify-between sm:justify-around items-start">
                <div>
                    <h3 class="text-lg text-[rgba(0,0,0,0.6)] font-semibold">Total Laporan</h3>
                    <p class="text-2xl font-bold mt-2">{{$laporanCount ? $laporanCount : "-"}}</p>
                </div>
                <div style="background-color: rgba(4, 173, 145, 0.3);" class="w-14 h-14 rounded-2xl flex items-center justify-center">
                    <span class="iconify text-3xl text-[#4AD991]" data-icon="lucide:chart-line" data-inline="false"></span>
                </div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md sm:w-[262px] w-full flex justify-between sm:justify-around items-start">
                <div>
                    <h3 class="text-lg text-[rgba(0,0,0,0.6)] font-semibold">Total Mahasiswa</h3>
                    <p class="text-2xl font-bold mt-2">{{$usersCount ? $usersCount : "0"}}</p>
                </div>
                <div style="background-color: rgba(4, 173, 145, 0.3);" class="w-14 h-14 rounded-2xl flex items-center justify-center">
                    <span class="iconify text-3xl text-[#4AD991]" data-icon="lucide:chart-line" data-inline="false"></span>
                </div>
            </div>
        </div>

        <!-- Example of other content -->
        <div class="flex justify-between items-center mt-8">
            <h3 class="text-2xl sm:text-3xl font-semibold">Laporan Cepat</h3>
            <a href="{{ route('admin.historyLaporan') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Selengkapnya</a>
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
                        @foreach ($recentReports as $report)
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
                                @if ($report->status == 'completed')
                                    <a href="{{ route('admin.processReport', $report->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Lihat</a>
                                @else
                                    <a href="{{ route('admin.processReport', $report->id) }}" class="bg-green-500 text-white px-4 py-2 rounded-md">Proses</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

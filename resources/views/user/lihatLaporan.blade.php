@extends('layouts.appUser')

@section('contentUser')
    <div class="p-6">

        <!-- Upload Image Section -->
        <div class="bg-white shadow-lg p-14 rounded-lg">
            <div class="mb-6 flex justify-between">
                <div>
                    <label for="nama" class="block text-md text-gray-700">Nama : </label>
                    <p class="text-lg text-black">{{$report->user->name}}</p>
                </div>
                <p>Status :  
                    @if ($report->status == 'pending')
                        <span class="bg-red-500 bg-opacity-20 text-red-700 px-4 py-2 rounded-md font-bold">Pending</span>
                    @elseif ($report->status == 'processing')
                        <span class="bg-blue-500 bg-opacity-20 text-blue-700 px-4 py-2 rounded-md font-bold">Processing</span>
                    @elseif ($report->status == 'completed')
                        <span class="bg-green-500 bg-opacity-20 text-green-700 px-4 py-2 rounded-md font-bold">Completed</span>
                    @endif
                </p>
            </div>
            <div class="mb-6">
                <label for="nim" class="block text-md text-gray-700">NIM : </label>
                <p class="text-lg text-black">{{$report->user->nik}}</p>
            </div>
            <div class="mb-6 flex justify-between">
                <div>
                    <label for="upload_image" class="block text-md text-gray-700">Jenis Laporan : </label>
                    <p class="text-lg text-black">{{$report->jenisLaporan}}</p>
                </div>
            </div>
            <div class="mb-6">
                <label for="upload_image" class="block text-md text-gray-700">Bukti Pembayaran : </label>
                <a href="{{ asset('storage/' . $report->buktiLaporan) }}" target="_blank" class="inline-block">
                    <img src="{{ asset('storage/' . $report->buktiLaporan) }}" alt="bukti transaksi" style="max-width: 100px; max-height: 100px; margin: 0;">
                </a>
            </div>

            <!-- Input Text Section -->
            <div class="mb-6">
                <label for="text_input" class="block text-md  text-gray-700">Keluhan Mahasiswa</label>
                <textarea disabled id="text_input" name="text_input" class="mt-1 block w-full h-[150px]  text-gray-700 border border-gray-300 rounded-md p-2 bg-[#F5F6FA] resize-none" style="vertical-align: top;">{{$report->keterangan}}</textarea>
            </div>
        </div>

        <!-- Balas Keluhan Section -->
        <h2 class="my-6 text-3xl font-semibold text-gray-700">Balasan Admin</h2>
        <div class="bg-white shadow-lg p-6 rounded-lg">
            <div class="mb-6">
                <textarea disabled id="balas_keluhan" placeholder="Masih belum ada balasan...." name="balas_keluhan" class="mt-1 block w-full h-[150px] text-gray-700 border border-gray-300 rounded-md p-2 bg-[#F5F6FA] resize-none" style="vertical-align: top;">{{$report->balasanAdmin}}</textarea>
            </div>
        </div>
    </div>
@endsection

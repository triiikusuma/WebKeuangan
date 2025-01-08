@extends('layouts.appAdmin')

@section('contentAdmin')
    <div class="p-6">

        <!-- Upload Image Section -->
        <div class="bg-white shadow-lg p-6 sm:p-14 rounded-lg">
            <div class="mb-6 flex justify-between">
                <div>
                    <label for="nama" class="block text-md text-gray-700">Nama : </label>
                    <p class="text-lg text-black">{{$report->user->name}}</p>
                </div>
                @if ($report->status == 'pending')
                    <p>Status : <span class="bg-red-500 bg-opacity-20 text-red-700 px-4 py-2 rounded-md font-bold">Pending</span></p>
                @elseif ($report->status == 'processing')
                <p>Status :  <span class="bg-blue-500 bg-opacity-20 text-blue-700 px-4 py-2 rounded-md font-bold">Process</span></p>
                @elseif ($report->status == 'completed')
                    <p>Status : <span class="bg-green-500 bg-opacity-20 text-green-700 px-4 py-2 rounded-md font-bold">Completed</span></p>
                @endif
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
                <textarea disabled id="text_input" name="text_input" class="mt-1 block w-full h-[150px]  text-gray-700 border border-gray-300 rounded-md p-2 bg-[#F5F6FA] resize-none" style="vertical-align: top;">{{ $report->keterangan }}</textarea>
            </div>
        </div>

        <!-- Balas Keluhan Section -->
    <form action="{{route('admin.updateReport', $report->id)}}" method="POST">
        @csrf
        @method('patch')
        <!-- Balas Keluhan Section -->
        <h2 class="my-6 text-3xl font-semibold text-gray-700">Balas Keluhan</h2>
        <div class="bg-white shadow-lg p-6 rounded-lg">
            <div class="mb-6">
                <textarea id="balasanAdmin" placeholder="Masih belum ada balasan...." name="balasanAdmin" class="mt-1 block w-full h-[150px] text-gray-700 border border-gray-300 rounded-md p-2 bg-[#F5F6FA] resize-none" style="vertical-align: top;" required>{{$report->balasanAdmin}}</textarea>
            </div>

            <!-- Submit Button Section -->
            <div class="mb-6">
                <button type="submit" class="px-6 py-2 w-full bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700">Submit</button>
            </div>
        </div>
    </form>
    </div>
@endsection

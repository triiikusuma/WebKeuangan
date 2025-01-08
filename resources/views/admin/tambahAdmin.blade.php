@extends('layouts.appAdmin')

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
<div class="p-4 sm:p-6">
    <div class="flex justify-between items-center mt-2">
        <h3 class="text-2xl sm:text-3xl font-semibold">Tambah Admin</h3>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md mt-6">
        <form action="{{ route('admin.storeAdmin') }}" method="post" class="flex flex-col gap-3">
            @csrf
            <div class="flex flex-col">
                <label for="name" class="text-lg font-semibold mb-2">NIM</label>
                <input type="text" name="nik" id="nik" class="border border-gray-300 rounded-md px-4 py-2" required maxlength="10">
            </div>
            @error('nik')
            {{ $message }}
            @enderror
            <div class="flex flex-col">
                <label for="name" class="text-lg font-semibold mb-2">Nama</label>
                <input type="text" name="name" id="name" class="border border-gray-300 rounded-md px-4 py-2" required>
            </div>
            @error('name')
            {{ $message }}
            @enderror
            <div class="flex flex-col">
                <label for="name" class="text-lg font-semibold mb-2">Email</label>
                <input type="email" name="email" id="email" class="border border-gray-300 rounded-md px-4 py-2" required>
            </div>
            @error('email')
            {{ $message }}
            @enderror
            <div class="flex flex-col mb-5">
                <label for="name" class="text-lg font-semibold mb-2">No Telefon</label>
                <input type="text" name="phone" id="phone" class="border border-gray-300 rounded-md px-4 py-2" required maxlength="15">
            </div>
            @error('phone')
            {{ $message }}
            @enderror
            <div class="flex flex-col mb-5">
                <label for="name" class="text-lg font-semibold mb-2">Password</label>
                <input type="password" name="password" id="password" class="border border-gray-300 rounded-md px-4 py-2" required>
            </div>
            @error('password')
            {{ $message }}
            @enderror
            <div class="flex flex-col mb-5">
                <label for="name" class="text-lg font-semibold mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="border border-gray-300 rounded-md px-4 py-2" required>
            </div>
            <div class="mt-5">
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md ">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

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
        <h3 class="text-2xl sm:text-3xl font-semibold">Edit data admin</h3>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md mt-6">
        <form action="{{ route('profile.update') }}" method="post" class="flex flex-col gap-3">
            @csrf
            @method('patch')
            @php
                $user = Auth::user();
            @endphp
            <div class="flex flex-col">
                <label for="name" class="text-lg font-semibold mb-2">NIM</label>
                <input type="text" name="nik" id="nik" class="border border-gray-300 rounded-md px-4 py-2" value="{{$user->nik}}" maxlength="10" required>
            @error('nik')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
            </div>
            <div class="flex flex-col">
                <label for="name" class="text-lg font-semibold mb-2">Nama</label>
                <input type="text" name="name" id="name" class="border border-gray-300 rounded-md px-4 py-2" value="{{$user->name}}" required>
            @error('name')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
            </div>
            <div class="flex flex-col">
                <label for="name" class="text-lg font-semibold mb-2">Email</label>
                <input type="email" name="email" id="email" class="border border-gray-300 rounded-md px-4 py-2" value="{{$user->email}}" required>
            @error('email')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
            </div>
            <div class="flex flex-col mb-5">
                <label for="name" class="text-lg font-semibold mb-2">No Telefon</label>
                <input type="text" name="phone" id="phone" class="border border-gray-300 rounded-md px-4 py-2" value="{{$user->phone}}" maxlength="15" required>
            @error('phone')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
            </div>
            <div class="mt-5">
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md ">Simpan</button>
            </div>
        </form>
    </div>

    <div class="flex justify-between items-center mt-6">
        <h3 class="text-2xl sm:text-3xl font-semibold">Edit password admin</h3>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md mt-6">
        <form action="{{ route('password.update') }}" method="post" class="flex flex-col gap-3">
            @csrf
            @method('put')
            <div class="flex flex-col">
                <label for="name" class="text-lg font-semibold mb-2">Password Lama</label>
                <input type="password" name="current_password" id="update_password_current_password" class="border border-gray-300 rounded-md px-4 py-2" required>
            </div>
            <div class="flex flex-col">
                <label for="name" class="text-lg font-semibold mb-2">Password Baru</label>
                <input type="password" name="password" id="update_password_password" class="border border-gray-300 rounded-md px-4 py-2" required>
            </div>
            <div class="flex flex-col">
                <label for="name" class="text-lg font-semibold mb-2">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" id="update_password_password_confirmation" class="border border-gray-300 rounded-md px-4 py-2" required>
            </div>
            @if(session('password'))
                {{ session('password') }}
            @endif
            <div class="mt-5">
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md ">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

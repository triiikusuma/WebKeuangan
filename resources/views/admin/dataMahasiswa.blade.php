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
        <h3 class="text-2xl sm:text-3xl font-semibold">Data Mahasiswa</h3>
        <a href="{{ route('admin.addUser') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Tambah Mahasiswa</a>
    </div>

    <div class="mt-8 bg-white p-6 rounded-lg shadow-md flex items-center justify-center">
        <div class="w-full overflow-x-auto">
            <table class="mt-4 w-full text-sm">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-center">NO</th>
                        <th class="px-4 py-2 text-center">NIM</th>
                        <th class="px-4 py-2 text-center">Nama</th>
                        <th class="px-4 py-2 text-center">Email</th>
                        <th class="px-4 py-2 text-center">No Telefon</th>
                        <th class="px-4 py-2 text-center">Status</th>
                        <th class="px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr class="h-24">
                        <td class="px-4 py-2 border-t border-b text-center">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border-t border-b text-center">{{$user->nik}}</td>
                        <td class="px-4 py-2 border-t border-b text-center">{{$user->name}}</td>
                        <td class="px-4 py-2 border-t border-b text-center">{{$user->email}}</td>
                        <td class="px-4 py-2 border-t border-b text-center">{{$user->phone}}</td>
                        <td class="px-4 py-2 border-t border-b text-center">
                            @if ($user->status == 'active')
                                <span class="bg-green-500 bg-opacity-20 text-green-700 px-4 py-2 rounded-md font-bold">Active</span>
                            @elseif ($user->status == 'inactive')
                                <span class="bg-red-500 bg-opacity-20 text-red-700 px-4 py-2 rounded-md font-bold">Inactive</span>
                            @elseif ($user->status == 'blacklist')
                                <span class="bg-black bg-opacity-90 text-white px-4 py-2 rounded-md font-bold">Blacklist</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border-t border-b text-center">
                            @if ($user->status == 'active')
                                <form action="{{ route('admin.nonactiveUser', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('patch')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">Nonaktif</button>
                                </form>
                                <form action="{{ route('admin.blacklistUser', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('patch')
                                    <button type="submit" class="bg-black text-white px-4 py-2 rounded-md">Blacklist</button>
                                </form>
                            @elseif ($user->status == 'inactive')
                                <form action="{{ route('admin.activeUser', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('patch')
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">Aktif</button>
                                </form>
                                <form action="{{ route('admin.blacklistUser', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('patch')
                                    <button type="submit" class="bg-black text-white px-4 py-2 rounded-md">Blacklist</button>
                                </form>
                            @elseif ($user->status == 'blacklist')
                                <form action="{{ route('admin.nonactiveUser', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('patch')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">Nonaktif</button>
                                </form>
                                <form action="{{ route('admin.activeUser', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('patch')
                                    <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">Whitelist</button>
                                </form>
                            @endif
                            <a href="{{ route('admin.editDataUser', $user->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

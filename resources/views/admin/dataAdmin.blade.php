@extends('layouts.appAdmin')

@section('contentAdmin')
<div class="p-4 sm:p-6">
    <div class="flex justify-between items-center mt-2">
        <h3 class="text-2xl sm:text-3xl font-semibold">Data Admin</h3>
        <a href="{{ route('admin.addAdmin') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Tambah Admin</a>
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
                    @foreach ($admins as $user)
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

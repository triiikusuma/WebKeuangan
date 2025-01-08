<div class="flex justify-between items-center bg-white sm:px-10 px-4 py-3">
    <!-- Mobile Hamburger Menu Button -->
    <button onclick="toggleSidebar()" class="md:hidden p-2 text-lg rounded-md">
        ☰
    </button>

    <!-- Search Bar -->
    <div class="flex items-center space-x-4">
        <div class="relative">
            <span class="iconify absolute left-3 top-1/2 transform -translate-y-1/2 text-2xl text-gray-400" data-icon="mdi:magnify" data-inline="false"></span>
            <form action="{{ route('laporan.index')}}" method="GET">
                <input type="text" name="search" placeholder="Search" class="border border-gray-300 bg-[#F5F6FA] text-gray-400 px-4 py-2 rounded-full pl-10" onkeydown="if(event.key === 'Enter'){ this.form.submit(); }">
            </form>
        </div>
    </div>

    {{-- User Avatar  --}}
    @php
        $user = Auth::user();
    @endphp
    <div class="flex items-center space-x-4">
        <div class="relative flex gap-3 ">
            <button class="bg-gray-800 text-white w-10 h-10 rounded-full"></button>
            <div class="hidden sm:flex sm:flex-col">
                <p>{{$user->name}}</p>
                <span class="text-xs text-gray-400">Mahasiswa</span>
            </div>
        </div>
    </div>
</div>

<div id="sidebar" class="w-64 bg-white text-black fixed inset-0 md:block hidden z-10">
    <div class="p-6">
        <h1 class="text-2xl font-bold ">Admin Panel</h1>
    </div>
    <ul>
        <li>
            <a href="{{ route('admin.dashboard') }}" class="py-2 px-4 hover:bg-blue-500 hover:text-white flex items-center gap-2 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-500 text-white' : '' }}">
                <span class="iconify text-3xl" data-icon="ant-design:dashboard-outlined" data-inline="false"></span>
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('admin.historyLaporan') }}" class="py-2 px-4 hover:bg-blue-500 hover:text-white flex items-center gap-2 {{ request()->routeIs('admin.historyLaporan') ? 'bg-blue-500 text-white' : '' }}">
                <span class="iconify text-3xl" data-icon="material-symbols-light:window-outline" data-inline="false"></span>
                History Laporan
            </a>
        </li>
        <li>
            <a href="{{ route('admin.manageUser') }}" class="py-2 px-4 hover:bg-blue-500 hover:text-white flex items-center gap-2 {{ request()->routeIs('admin.manageUser') ? 'bg-blue-500 text-white' : '' }}">
                <span class="iconify text-3xl" data-icon="charm:person" data-inline="false"></span>
                Data Mahasiswa
            </a>
        </li>
        <li>
            <a href="{{ route('admin.manageAdmin') }}" class="py-2 px-4 hover:bg-blue-500 hover:text-white flex items-center gap-2 {{ request()->routeIs('admin.manageAdmin') ? 'bg-blue-500 text-white' : '' }}">
                <span class="iconify text-3xl" data-icon="charm:person" data-inline="false"></span>
                Data Admin
            </a>
        </li>
        <li>
            <a href="{{ route('admin.settingAdmin', Auth::user()->id ) }}" class="py-2 px-4 hover:bg-blue-500 hover:text-white flex items-center gap-2 {{ request()->routeIs('admin.settingAdmin') ? 'bg-blue-500 text-white' : '' }}">
                <span class="iconify text-3xl" data-icon="mdi:gear-outline" data-inline="false"></span>
                Settings
            </a>
        </li>
        <li>
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full py-2 px-4 hover:bg-blue-500 hover:text-white flex items-center gap-2">
                    <span class="iconify text-3xl" data-icon="tabler:power" data-inline="false"></span>
                    Logout
                </button>
            </form>
        </li>
    </ul>
</div>

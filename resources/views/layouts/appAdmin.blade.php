<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
    <script>
        // Toggle Sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('hidden');
            overlay.classList.toggle('hidden');
        }
    </script>
    <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.24/dist/sweetalert2.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 overflow-x-hidden">
    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('partials.partialAdmin.sidebar')

        <!-- Overlay for Sidebar -->
        <div id="overlay" onclick="toggleSidebar()" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 z-5"></div>

        <!-- Main Content -->
        <div class="flex-1 ml-0 md:ml-64 transition-all duration-300 overflow-x-hidden">
            <!-- Header -->
            @include('partials.partialAdmin.header')

            <!-- Content Section -->
            <div class="p-2 sm:p-6">
                @yield('contentAdmin')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.24/dist/sweetalert2.min.js"></script>

</body>
</html>

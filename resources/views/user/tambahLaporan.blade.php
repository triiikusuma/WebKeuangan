@extends('layouts.appUser')

@section('contentUser')
    <div class="p-6">
        <form action="{{ route('user.storeLaporan') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h2 class="text-3xl font-semibold text-gray-700 mb-4">Tambah Laporan</h2>
            <div class="bg-white shadow-lg p-14 rounded-lg">
                <div class="mb-6 flex justify-between">
                    <div class="form-group">
                        <label for="jenis_laporan" class="block text-md text-gray-700">Jenis Laporan</label>
                        <select id="jenis_laporan" name="jenis_laporan"
                            class="mt-1 block bg-gray-100 border border-gray-300 p-3 pr-8">
                            <option value="Pembayaran SPP" {{ old('jenis_laporan') == 'Pembayaran SPP' ? 'selected' : '' }}>
                                Pembayaran SPP</option>
                            <option value="Pembayaran Skripsi"
                                {{ old('jenis_laporan') == 'Pembayaran Skripsi' ? 'selected' : '' }}>Pembayaran Skripsi
                            </option>
                            <option value="Pembayaran Wisuda"
                                {{ old('jenis_laporan') == 'Pembayaran Wisuda' ? 'selected' : '' }}>Pembayaran Wisuda
                            </option>
                        </select>
                    </div>
                </div>
                <div class="mb-6 form-group">
                    <label for="upload_image" class="block text-md text-gray-700">Upload Bukti Pembayaran</label>
                    <input type="file" id="buktiLaporan" name="buktiLaporan" class="my-2 block text-gray-700 " required>
                    <div id="imagePreview" class="mt-4">
                        <img id="previewImg" src="#" alt="Preview Image" class="max-w-full h-auto rounded-lg"
                            style="display: none;">
                    </div>
                    <script>
                        document.getElementById('buktiLaporan').addEventListener('change', function(event) {
                            const [file] = event.target.files;
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    const previewImg = document.getElementById('previewImg');
                                    previewImg.src = e.target.result;
                                    previewImg.style.display = 'block';
                                    previewImg.style.maxWidth = '200px';
                                    previewImg.style.maxHeight = '200px';
                                };
                                reader.readAsDataURL(file);
                            }
                        });
                    </script>
                </div>

                <!-- Input Text Section -->
                <div class="mb-6 form-group">
                    <label for="text_input" class="block text-md  text-gray-700">Ketik Keluhan</label>
                    <textarea placeholder="Ketik keluhan kamu disini" id="keterangan" name="keterangan"
                        class="mt-1 block w-full h-[150px]  text-gray-700 border border-gray-300 rounded-md p-2 bg-[#F5F6FA] resize-none"
                        style="vertical-align: top;" required></textarea>
                </div>
                <button type="submit"
                    class="px-6 py-2 w-full bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700">Submit</button>
        </form>
    </div>
    </div>
@endsection

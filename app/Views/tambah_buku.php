<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar - Kept unchanged -->
        <div class="w-64 bg-white shadow-lg">
            <div class="p-4">
                <div class="flex items-center space-x-2">
                    <img src="assets/img/logo.png" alt="Logo" class="w-8 h-8">
                    <div>
                        <h1 class="text-lg font-semibold text-gray-800">E-Library SDN</h1>
                        <p class="text-sm text-gray-600">Jelambar Baru 07</p>
                    </div>
                </div>
            </div>

            <!-- Navigation - Kept unchanged -->
            <nav class="mt-6">
                <a href="/beranda" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Beranda
                </a>

                <a href="/buku" class="flex items-center px-6 py-3 bg-gradient-to-b from-[#EC2C5A] to-[#FA7C54] text-white">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Buku
                </a>

                <a href="/anggota" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Anggota
                </a>

                <a href="#" class="flex items-center px-6 py-3 text-red-500 hover:bg-gray-100 mt-auto">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Keluar
                </a>
            </nav>
        </div>

        <!-- Main Content - Modified -->
        <div class="flex-1 p-8">
            <!-- Header with name and title -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold bg-gradient-to-b from-[#EC2C5A] to-[#FA7C54] bg-clip-text text-transparent">Tambah Buku</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Henny Indriani</span>
                </div>
            </div>

            <!-- Form Content -->
            <div class="bg-white rounded-lg shadow-md p-6 max-w-4xl mx-auto">
                <form class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sampul Buku*</label>
                        <div class="flex items-center">
                            <button type="button" class="px-4 py-2 bg-gradient-to-b from-[#FA7C54] to-[#EC2C5A] text-white rounded hover:bg-red-600">
                                Choose file
                            </button>
                            <span class="ml-3 text-sm text-gray-500">No file chosen</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul*</label>
                        <input type="text" class="w-full p-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500" value="Matematika itu asik">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">ISBN</label>
                        <input type="text" class="w-full p-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500" value="12345678">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pengarang*</label>
                        <input type="text" class="w-full p-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500" value="Ahmad Heriawan">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penerbit*</label>
                        <input type="text" class="w-full p-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500" value="Bintang di Langit">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Terbit*</label>
                        <input type="text" class="w-full p-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Pilih Tahun">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pengadaan*</label>
                        <input type="text" class="w-full p-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Pilih Tanggal">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori*</label>
                        <div class="space-y-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="category" checked class="text-red-500 focus:ring-red-500">
                                <span class="ml-2">Kelas 1</span>
                            </label>
                            <label class="inline-flex items-center ml-6">
                                <input type="radio" name="category" class="text-red-500 focus:ring-red-500">
                                <span class="ml-2">Kelas 2</span>
                            </label>
                            <!-- Add other categories as needed -->
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sinopsis</label>
                        <textarea class="w-full p-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500" rows="4" placeholder="Write text here ..."></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Format*</label>
                        <div class="space-y-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" checked class="text-red-500 focus:ring-red-500">
                                <span class="ml-2">E-Book</span>
                            </label>
                            <label class="inline-flex items-center ml-6">
                                <input type="checkbox" checked class="text-red-500 focus:ring-red-500">
                                <span class="ml-2">Buku Fisik</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Upload E-Book</label>
                        <div class="flex items-center">
                            <button type="button" class="px-4 py-2 bg-gradient-to-b from-[#FA7C54] to-[#EC2C5A] text-white rounded hover:bg-red-600">
                                Choose file
                            </button>
                            <span class="ml-3 text-sm text-gray-500">No file chosen</span>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">.pdf</p>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full py-2 px-4 bg-gradient-to-b from-[#FA7C54] to-[#EC2C5A] text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
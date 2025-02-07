<?= $this->extend('layouts/main_admin') ?>
<?= $this->section('content') ?>

<body class="bg-gray-100 flex flex-col w-full h-full">

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8 p-4 rounded-lg">
                <h1 class="text-2xl font-bold bg-gradient-to-b from-[#EC2C5A] to-[#FA7C54] bg-clip-text text-transparent">Tambah Anggota</h1>
            </div>

            <!-- Add Member Form -->
            <div class="bg-white rounded-lg shadow-lg p-6 max-w-3xl mx-auto">
                <form class="space-y-6">
                    <!-- Profile Photo Upload -->
                    <div class="flex justify-center">
                        <div class="relative">
                            <div class="w-32 h-32 bg-gray-200 rounded-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Form Fields -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                            <div class="mt-2 space-y-2">
                                <div class="flex items-center">
                                    <input type="radio" name="gender" class="focus:ring-red-500 h-4 w-4 text-red-600 border-gray-300">
                                    <label class="ml-3 block text-sm text-gray-700">Perempuan</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" name="gender" class="focus:ring-red-500 h-4 w-4 text-red-600 border-gray-300">
                                    <label class="ml-3 block text-sm text-gray-700">Laki-laki</label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Level</label>
                            <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                                <option>Kelas 1</option>
                                <option>Kelas 2</option>
                                <option>Kelas 3</option>
                                <option>Kelas 4</option>
                                <option>Kelas 5</option>
                                <option>Kelas 6</option>
                                <option>Guru</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Alamat</label>
                            <textarea class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500" rows="3"></textarea>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-gradient-to-b from-[#FA7C54] to-[#EC2C5A] text-white px-6 py-2 rounded-lg hover:opacity-90 transition-opacity">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<?= $this->endSection() ?>
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <main class="flex-grow bg-gray-50">
        <!-- Hero Section (Aligned Text & Image) -->
        <div class="bg-orange-100">
    <div class="container mx-auto px-6 py-8 flex w-full sm:flex-row justify-between items-center ">
        
        <!-- ✅ Text Content -->
        <div class="max-w-md text-left">
            <h2 class="text-4xl md:text-4xl font-bold mb-3 text-gray-900 leading-tight">
                "Meningkatnya minat baca siswa SD melalui program bacaan yang menarik dan kegiatan literasi yang inovatif."
            </h2>
            <p class="text-gray-700 text-sm md:text-base mt-2">- VISI PERPUSTAKAAN SDN JELAMBAR BARU 07</p>
        </div>

        <!-- ✅ Properly Scaled Image -->
        <div class="flex-shrink-0">
            <img src="<?= base_url('assets/img/lpadmin_small.jpg') ?>" 
                 alt="School Library" 
                 class=" w-[400px] md:w-[360px] lg:w-[400px] h-auto object-cover">
        </div>
    </div>
</div>





   


        <!-- Filters (Responsive) -->
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-wrap justify-center md:justify-start gap-2 mb-8">
                <button class="px-4 py-2 rounded-full bg-orange-500 text-white">Semua Buku</button>
                <button class="px-4 py-2 rounded-full bg-gray-200 hover:bg-gray-700 hover:text-white">Kelas 1</button>
                <button class="px-4 py-2 rounded-full bg-gray-200 hover:bg-gray-700 hover:text-white">Kelas 2</button>
                <button class="px-4 py-2 rounded-full bg-gray-200 hover:bg-gray-700 hover:text-white">Kelas 3</button>
                <button class="px-4 py-2 rounded-full bg-gray-200 hover:bg-gray-700 hover:text-white">Kelas 4</button>
                <button class="px-4 py-2 rounded-full bg-gray-200 hover:bg-gray-700 hover:text-white">Kelas 5</button>
                <button class="px-4 py-2 rounded-full bg-gray-200 hover:bg-gray-700 hover:text-white">Kelas 6</button>
                <button class="px-4 py-2 rounded-full bg-gray-200 hover:bg-gray-700 hover:text-white">Non Fiksi</button>
                <button class="px-4 py-2 rounded-full bg-gray-200 hover:bg-gray-700 hover:text-white">Dongeng</button>
                <button class="px-4 py-2 rounded-full bg-gray-200 hover:bg-gray-700 hover:text-white">Sains</button>
                <button class="px-4 py-2 rounded-full bg-gray-200 hover:bg-gray-700 hover:text-white">Komik</button>
                <button class="px-4 py-2 rounded-full bg-gray-200 hover:bg-gray-700 hover:text-white">Novel</button>
            </div>

            <!-- Book Grid (Responsive) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" id="bookContainer">
                <!-- Book Card Template -->
                <div class="bg-white rounded-lg shadow-md p-6 flex flex-col sm:flex-row gap-4">
                    <img src="/book-cover.jpg" alt="Book Cover" class="w-32 object-cover">
                    <div class="flex-1">
                        <h3 class="font-bold text-lg mb-2">(Judul)</h3>
                        <p class="text-sm text-gray-600 mb-1">(nama pengarang), (nama penerbit), (tahun)</p>
                        <p class="text-sm text-gray-500 mb-2">(kategori)</p>
                        <p class="text-sm text-gray-600 mb-4">Sinopsis</p>
                        <p class="text-xs text-gray-400 mb-2">ISBN: (ISBN)</p>
                        <div class="flex gap-2">
                            <button class="bg-orange-500 text-white px-4 py-1 rounded-full text-sm">E-Book</button>
                            <button class="bg-white border border-green-500 text-green-500 px-4 py-1 rounded-full text-sm">Buku Fisik</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

<?= $this->endSection() ?>

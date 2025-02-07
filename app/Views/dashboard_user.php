<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet"></head>
<body class="bg-gray-50 flex min-h-screen flex-col">
    <!-- Header -->
    <header class="bg-orange-500 text-white sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <img src="assets/img/logo.png" alt="Logo" class="w-10 h-10">
                <h1 class="text-xl font-bold">E-Library SDN Jelambar Baru 07</h1>
            </div>
            <div class="space-x-4">
                <a href="#" class="hover:underline">Profil</a>
                <a href="#" class="hover:underline">Keluar</a>
            </div>
        </div>
    </header>

    <main class="flex-grow bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-orange-100">
        <div class="container mx-auto px-4 py-8 flex justify-between items-center">
            <div class="max-w-xl">
                <h2 class="text-2xl font-bold mb-4">
                    "Meningkatnya minat baca siswa SD melalui program bacaan yang menarik dan kegiatan literasi yang inovatif."
                </h2>
                <p class="text-gray-600">- VISI PERPUSTAKAAN SDN JELAMBAR BARU 07</p>
            </div>
            <img src="assets/img/LP_Admin.jpg" alt="School Library" class="rounded-lg shadow-lg w-96">
        </div>
    </div>

    <!-- Filters -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-wrap gap-2 mb-8">
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

        <!-- Book Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="bookContainer">
            <!-- Book Card Template -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex gap-4">
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

        <!-- Pagination -->
        <div class="flex justify-center gap-2 mt-8">
            <button class="px-4 py-2 text-sm">Sebelumnya</button>
            <button class="w-8 h-8 rounded-full bg-orange-500 text-white">1</button>
            <button class="w-8 h-8 rounded-full bg-gray-200">2</button>
            <button class="w-8 h-8 rounded-full bg-gray-200">3</button>
            <button class="px-4 py-2 text-sm">Selanjutnya</button>
        </div>
    </div>

    </main>
    <!-- Footer -->
    <footer class="bg-orange-100 mt-auto py-4">
        <div class="container mx-auto text-center">
            <h2 class="font-bold mb-2">E-Library SDN Jelambar Baru 07</h2>
            <p class="text-sm text-gray-600">© Copyright 2025 SDN Jelambar Baru 07</p>
        </div>
    </footer>

    <script>
        // Function to fetch and display books
        async function fetchBooks() {
            try {
                // Replace with your actual API endpoint
                const response = await fetch('your-api-endpoint');
                const books = await response.json();
                
                const bookContainer = document.getElementById('bookContainer');
                bookContainer.innerHTML = ''; // Clear existing content
                
                books.forEach(book => {
                    const bookCard = `
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <div class="flex gap-4">
                                <img src="${book.coverImage}" alt="${book.title}" class="w-32 object-cover">
                                <div class="flex-1">
                                    <h3 class="font-bold text-lg mb-2">${book.title}</h3>
                                    <p class="text-sm text-gray-600 mb-1">${book.author}, ${book.publisher}, ${book.year}</p>
                                    <p class="text-sm text-gray-500 mb-2">${book.category}</p>
                                    <p class="text-sm text-gray-600 mb-4">${book.synopsis}</p>
                                    <p class="text-xs text-gray-400 mb-2">ISBN: ${book.isbn}</p>
                                    <div class="flex gap-2">
                                        <button class="bg-orange-500 text-white px-4 py-1 rounded-full text-sm">E-Book</button>
                                        <button class="bg-white border border-green-500 text-green-500 px-4 py-1 rounded-full text-sm">Buku Fisik</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    bookContainer.innerHTML += bookCard;
                });
            } catch (error) {
                console.error('Error fetching books:', error);
            }
        }

        // Add event listeners for filters
        const filterButtons = document.querySelectorAll('.filter-button');
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('bg-orange-500', 'text-white'));
                // Add active class to clicked button
                button.classList.add('bg-orange-500', 'text-white');
                // Fetch filtered books (implement filter logic)
                fetchBooks();
            });
        });

        // Initial load
        fetchBooks();
    </script>
</body>
</html>
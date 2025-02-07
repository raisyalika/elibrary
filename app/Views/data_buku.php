<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buku</title>
  <link href="<?= base_url('css/style.css') ?>" rel="stylesheet"></head>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
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

            <!-- Navigation -->
            <nav class="mt-6">
                <a href="beranda" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Beranda
                </a>

                <a href="buku" class="flex items-center px-6 py-3 bg-gradient-to-b from-[#EC2C5A] to-[#FA7C54] text-white">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Buku
                </a>

                <a href="anggota" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100">
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

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold bg-gradient-to-b from-[#EC2C5A] to-[#FA7C54] bg-clip-text text-transparent">Buku</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Henny Indriani</span>
                    <a href="buku/tambah_buku" class="bg-gradient-to-b from-[#FA7C54] to-[#EC2C5A] text-white px-4 py-2 rounded-lg flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Tambah Buku
                    </a>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="mb-6">
                <input type="text" 
                       placeholder="Search" 
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500"
                       id="searchInput">
            </div>

            <!-- Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NO</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID BUKU</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SAMPUL</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">JUDUL</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ISBN</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">KATEGORI</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PENGARANG</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PENERBIT</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TAHUN</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">AKSI</th>
                        </tr>
                    </thead>
                    <tbody id="bookTableBody">
                        <!-- Table rows will be inserted here by JavaScript -->
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="text-sm text-gray-700">
                        Showing <span id="startRange">1</span> to <span id="endRange">10</span> of <span id="totalEntries">100</span> Entries
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600" id="prevBtn">Prev</button>
                        <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600" id="nextBtn">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
      <div class="bg-white rounded-lg shadow-lg p-6 w-96">
          <h2 class="text-lg font-semibold text-gray-800 mb-4">Konfirmasi Hapus</h2>
          <p class="text-gray-600 mb-4">Apakah Anda yakin ingin menghapus buku ini?</p>
          <div class="flex justify-end space-x-4">
              <button id="cancelDelete" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
              <button id="confirmDelete" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Hapus</button>
          </div>
      </div>
    </div>


    <script>
      let bookIdDelete = null;
      
      
        // Sample data - replace this with actual API fetch
        const books = [
            {
                no: 1,
                idBuku: "1213",
                sampul: "/path/to/book1.jpg",
                judul: "Matematika itu asik",
                isbn: "123456869969",
                kategori: "Sains",
                pengarang: "Wiwi",
                penerbit: "Erlangga",
                tahun: "2017"
            },
            {
                no: 2,
                idBuku: "1113",
                sampul: "/path/to/book2.jpg",
                judul: "Dunia sophie",
                isbn: "123456262267",
                kategori: "Novel",
                pengarang: "Ahmad",
                penerbit: "Erlangga",
                tahun: "2023"
            },
            {
                no: 3,
                idBuku: "11122",
                sampul: "/path/to/book3.jpg",
                judul: "Si juki",
                isbn: "1918181818181",
                kategori: "Komik",
                pengarang: "Faza Meonk",
                penerbit: "Meluncur",
                tahun: "2022"
            }
        ];

        // Function to render table rows
        function renderTable(data) {
            const tableBody = document.getElementById('bookTableBody');
            tableBody.innerHTML = '';

            data.forEach(book => {
                const row = document.createElement('tr');
                row.className = 'hover:bg-gray-50';
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${book.no}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${book.idBuku}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="w-12 h-12 bg-gray-200 rounded">
                            <img src="${book.sampul}" alt="${book.judul}" class="w-full h-full object-cover rounded">
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${book.judul}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${book.isbn}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${book.kategori}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${book.pengarang}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${book.penerbit}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${book.tahun}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a href='buku/edit_buku' class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs">Edit</a>
                        <button onclick="openDeleteModal(${book.id})" class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs">Hapus</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        // Search functionality
        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            const filteredBooks = books.filter(book => 
                book.judul.toLowerCase().includes(searchTerm) ||
                book.pengarang.toLowerCase().includes(searchTerm) ||
                book.penerbit.toLowerCase().includes(searchTerm) ||
                book.kategori.toLowerCase().includes(searchTerm)
            );
            renderTable(filteredBooks);
        });

        // Initial render
        renderTable(books);

        // In a real application, you would fetch data like this:
        /*
        async function fetchBooks() {
            try {
                const response = await fetch('your-api-endpoint');
                const data = await response.json();
                renderTable(data);
            } catch (error) {
                console.error('Error fetching books:', error);
            }
        }
        fetchBooks();
        */

         // Buka Modal Delete
        function openDeleteModal(bookId) {
            bookIdToDelete = bookId;
            document.getElementById("deleteModal").classList.remove("hidden");
        }

        // Tutup Modal
        document.getElementById("cancelDelete").addEventListener("click", function () {
            document.getElementById("deleteModal").classList.add("hidden");
            bookIdToDelete = null;
        });

        // Konfirmasi Hapus
        document.getElementById("confirmDelete").addEventListener("click", function () {
            if (bookIdToDelete !== null) {
                deleteBook(bookIdToDelete);
                document.getElementById("deleteModal").classList.add("hidden");
                bookIdToDelete = null;
            }
        });

         // Hapus Buku dari Tabel
        function deleteBook(bookId) {
            const index = books.findIndex(book => book.id === bookId);
            if (index !== -1) {
                books.splice(index, 1);
                renderBooks(); // Render ulang tabel
            }
        }
    </script>
</body>
</html>
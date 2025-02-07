<?= $this->extend('layouts/main_admin') ?>
<?= $this->section('content') ?>

<div class="flex flex-col w-full h-full ">
    <div class="flex-1 p-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8  p-4 rounded-lg">
            <h1 class="text-2xl font-bold bg-gradient-to-b from-[#EC2C5A] to-[#FA7C54] bg-clip-text text-transparent">Buku</h1>
            <div class="flex items-center space-x-4">
                <span id="userName" class="text-gray-600"></span>
                <a href="buku/tambah_buku" class="bg-gradient-to-b from-[#FA7C54] to-[#EC2C5A] text-white px-4 py-2 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Tambah Buku
                </a>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="mb-6">
            <input type="text" id="searchInput" placeholder="Search"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500">
        </div>

        <!-- Table Container -->
        <div class="bg-white rounded-lg shadow overflow-auto">
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
        </div>

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

<!-- Delete Modal -->
<div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Konfirmasi Hapus</h2>
        <p class="text-gray-600 mb-4">Apakah Anda yakin ingin menghapus Anggota ini?</p>
        <div class="flex justify-end space-x-4">
            <button id="cancelDelete" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
            <button id="confirmDelete" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Hapus</button>
        </div>
    </div>
</div>



<script>
document.addEventListener("DOMContentLoaded", function () {
        let userData = localStorage.getItem("user"); 
        let token = localStorage.getItem("token");

        if (userData) {
        // Parse string JSON menjadi objek JavaScript
        let user = JSON.parse(userData);
        
        // Ambil elemen h1 untuk menampilkan nama
        let nameElement = document.getElementById("userName");

        // Tampilkan nama user di dalam h1
        nameElement.textContent = user.name;
        console.log("User:", user);
    } else {
        console.warn("User data tidak ditemukan di localStorage.");
    }

        // Jika ingin melihat semua isi localStorage
        console.log("Isi localStorage:", localStorage);

        if(token){
            fetchBooks(token);
        }
        else{
            console.warn("Token tidak ditemukan di localStorage.");
        }
    });

// 
    let bookIdToDelete = null;
    async function fetchBooks(token) {
    try {
        const response = await fetch("http://localhost:8080/api/books", {
            method: "GET",
            headers: {
                "Authorization": `Bearer ${token}`,
                "Content-Type": "application/json"
            }
        });
        
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        
        const result = await response.json();
        renderTable(result.data);
        console.log('result fetch',result.data)
    } catch (error) {
        console.error("Error fetching books:", error);
    }
}

    function renderTable(data) {
        const tableBody = document.getElementById('bookTableBody');
        tableBody.innerHTML = '';

        data.forEach((book,index) => {
            const row = document.createElement('tr');
            row.className = 'hover:bg-gray-50';
            row.innerHTML = `
                <td class="px-6 py-4 text-sm text-gray-900">${index+1}</td>
                <td class="px-6 py-4 text-sm text-gray-900">${book.id_buku}</td>
                <td class="px-6 py-4">
                    <div class="w-12 h-12 bg-gray-200 rounded">
                        <img src="${book.sampul}" alt="${book.judul}" class="w-full h-full object-cover rounded">
                    </div>
                </td>
                <td class="px-6 py-4 text-sm text-gray-900">${book.judul}</td>
                <td class="px-6 py-4 text-sm text-gray-900">${book.isbn}</td>
                <td class="px-6 py-4 text-sm text-gray-900">${book.kategori}</td>
                <td class="px-6 py-4 text-sm text-gray-900">${book.pengarang}</td>
                <td class="px-6 py-4 text-sm text-gray-900">${book.penerbit}</td>
                <td class="px-6 py-4 text-sm text-gray-900">${book.tahun}</td>
                <td class="px-6 py-4 space-x-2 flex">
                    <a href='buku/edit_buku?id=${book.id_buku}' class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs">Edit</a>
                    <button onclick="openDeleteModal(${book.id_buku})" class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs">Hapus</button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    document.getElementById('searchInput').addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();
        const filteredBooks = books.filter(book => book.judul.toLowerCase().includes(searchTerm));
        renderTable(filteredBooks);
    });



     // Buka Modal Delete
        function openDeleteModal(bookId) {
            anggotaIdDelete = bookId;
            document.getElementById("deleteModal").classList.remove("hidden");
        }

        // Tutup Modal
        document.getElementById("cancelDelete").addEventListener("click", function () {
            document.getElementById("deleteModal").classList.add("hidden");
            anggotaIdDelete = null;
        });

        // Konfirmasi Hapus
        document.getElementById("confirmDelete").addEventListener("click", function () {
            if (anggotaIdDelete !== null) {
                deleteBook(anggotaIdDelete);
                document.getElementById("deleteModal").classList.add("hidden");
                anggotaIdDelete = null;
            }
        });

         // Hapus Buku dari Tabel
        function deleteBook(anggotaId) {
            const index = anggotas.findIndex(anggota => anggota.id === anggotaId);
            if (index !== -1) {
                anggotas.splice(index, 1);
                renderBooks(); // Render ulang tabel
            }
        }

</script>

<?= $this->endSection() ?>

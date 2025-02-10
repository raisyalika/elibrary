<?= $this->extend('layouts/main_admin') ?>
<?= $this->section('content') ?>

<div class="flex flex-col w-full h-full">
    <div class="flex-1 p-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8 p-4 rounded-lg">
            <h1 class="text-2xl font-bold bg-gradient-to-b from-[#EC2C5A] to-[#FA7C54] bg-clip-text text-transparent">Buku</h1>
            <div class="flex items-center space-x-4">
                <span id="userName" class="text-gray-600"></span>
                <a href="<?= base_url('buku/tambah_buku') ?>" class="bg-gradient-to-b from-[#FA7C54] to-[#EC2C5A] text-white px-4 py-2 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
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
                <tbody id="bookTableBody"></tbody>
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

<script>
document.addEventListener("DOMContentLoaded", function () {
    const apiBaseUrl = "https://elibrary-jelambarbaru.my.id/api/books"// ✅ Directly use base_url for API calls
    let token = localStorage.getItem("token");

    if (token) fetchBooks(1);

    document.getElementById("searchInput").addEventListener("input", () => fetchBooks(1));
    document.getElementById("prevBtn").addEventListener("click", () => changePage(-1));
    document.getElementById("nextBtn").addEventListener("click", () => changePage(1));
});

let currentPage = 1;
let totalEntries = 0;
let perPage = 10;

async function fetchBooks(page = 1) {
    const apiBaseUrl = "<?= base_url('api/books') ?>";
    const searchQuery = document.getElementById("searchInput").value.trim();
    let queryParams = [`page=${page}`, `per_page=${perPage}`];
    if (searchQuery) queryParams.push(`search=${encodeURIComponent(searchQuery)}`);

    try {
        const response = await fetch(`${apiBaseUrl}?${queryParams.join("&")}`, {
            method: "GET",
            headers: {
                "Authorization": `Bearer ${localStorage.getItem("token")}`,
                "Content-Type": "application/json"
            }
        });

        if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

        const result = await response.json();
        totalEntries = result.pagination.total_books;
        currentPage = result.pagination.current_page;
        renderTable(result.data);
        updatePagination();
    } catch (error) {
        console.error("Error fetching books:", error);
    }
}

function renderTable(data) {
    const tableBody = document.getElementById("bookTableBody");
    tableBody.innerHTML = "";

    if (data.length === 0) {
        tableBody.innerHTML = `<tr><td colspan="10" class="text-center py-4">📭 Tidak ada hasil ditemukan.</td></tr>`;
        return;
    }

    data.forEach((book, index) => {
        const row = document.createElement("tr");
        row.className = "hover:bg-gray-50";
        row.innerHTML = `
            <td class="px-6 py-4">${(currentPage - 1) * perPage + index + 1}</td>
            <td class="px-6 py-4">${book.id_buku}</td>
            <td class="px-6 py-4"><img src="${book.sampul_url || '<?= base_url('assets/placeholder.jpg') ?>'}" alt="Cover" class="w-12 h-12 rounded"></td>
            <td class="px-6 py-4">${book.judul}</td>
            <td class="px-6 py-4">${book.isbn}</td>
            <td class="px-6 py-4">${book.kategori || "Tidak Ada"}</td>
            <td class="px-6 py-4">${book.pengarang}</td>
            <td class="px-6 py-4">${book.penerbit}</td>
            <td class="px-6 py-4">${book.tahun}</td>
            <td class="px-6 py-4">
                <a href="<?= base_url('buku/edit_buku?id=') ?>${book.id_buku}" class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs">Edit</a>
                <button onclick="deleteBook(${book.id_buku})" class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs">Hapus</button>
            </td>
        `;
        tableBody.appendChild(row);
    });
}
</script>

<?= $this->endSection() ?>

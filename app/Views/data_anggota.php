<?= $this->extend('layouts/main_admin') ?>
<?= $this->section('content') ?>

<body class="bg-gray-100 flex flex-col w-full h-full">
    <div class="flex-1 p-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8 p-4 rounded-lg">
            <h1 class="text-2xl font-bold bg-gradient-to-b from-[#EC2C5A] to-[#FA7C54] bg-clip-text text-transparent">Anggota</h1>
            <div class="flex items-center space-x-4">
                <span id="userName" class="text-gray-600"></span>
                <a href="<?= base_url('anggota/tambah_anggota') ?>" class="bg-gradient-to-b from-[#FA7C54] to-[#EC2C5A] text-white px-4 py-2 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Tambah Anggota
                </a>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="mb-6">
            <input type="text" id="searchInput" placeholder="Search" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500">
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow overflow-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NO</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NO ANGGOTA</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NAMA</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">JENIS KELAMIN</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">LEVEL</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ALAMAT</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">AKSI</th>
                    </tr>
                </thead>
                <tbody id="memberTableBody"></tbody>
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

    <!-- Delete Modal -->
    <div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Konfirmasi Hapus</h2>
            <p class="text-gray-600 mb-4">Apakah Anda yakin ingin menghapus anggota ini?</p>
            <div class="flex justify-end space-x-4">
                <button id="cancelDelete" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                <button id="confirmDelete" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Hapus</button>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", async function () {
        const apiBaseUrl = "<?= base_url('api/members') ?>";
        let token = localStorage.getItem("token");
        let userData = localStorage.getItem("user");

        if (userData) document.getElementById("userName").textContent = JSON.parse(userData).name;
        if (token) await fetchAnggota(token, 1);

        document.getElementById("searchInput").addEventListener("input", () => fetchAnggota(token, 1));
        document.getElementById("prevBtn").addEventListener("click", () => changePage(-1));
        document.getElementById("nextBtn").addEventListener("click", () => changePage(1));
    });

    let currentPage = 1;
    let totalEntries = 0;
    let perPage = 10;

    async function fetchAnggota(token, page = 1) {
    const searchQuery = document.getElementById("searchInput").value.trim();
    const url = new URL("<?= base_url('api/members') ?>");
    
    url.searchParams.append('page', page);
    url.searchParams.append('per_page', perPage);
    
    if (searchQuery) {
        url.searchParams.append('search', searchQuery);
    }

    console.log("Fetching members from URL:", url.toString());

    try {
        const response = await fetch(url.toString(), {
            method: "GET",
            headers: { 
                "Authorization": `Bearer ${token}`, 
                "Content-Type": "application/json",
                "Accept": "application/json"
            }
        });

        console.log("Response status:", response.status);

        if (!response.ok) {
            const errorData = await response.json();
            console.error("Error response:", errorData);
            throw new Error(errorData.message || `HTTP error! Status: ${response.status}`);
        }

        const result = await response.json();
        console.log("Received members data:", result);

        totalEntries = result.pagination.total_members;
        currentPage = result.pagination.current_page;
        renderTable(result.data);
        updatePagination();
    } catch (error) {
        console.error("Error fetching members:", error);
        // Optionally show an error message to the user
        alert(error.message || "Failed to fetch members");
    }
}

    function renderTable(data) {
        const tableBody = document.getElementById("memberTableBody");
        tableBody.innerHTML = "";

        if (data.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="7" class="text-center py-4">📭 Tidak ada hasil ditemukan.</td></tr>`;
            return;
        }

        data.forEach((member, index) => {
            tableBody.innerHTML += `
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">${(currentPage - 1) * perPage + index + 1}</td>
                    <td class="px-6 py-4">${member.id_anggota}</td>
                    <td class="px-6 py-4">${member.username}</td>
                    <td class="px-6 py-4">${member.jk_anggota}</td>
                    <td class="px-6 py-4">${member.level_anggota}</td>
                    <td class="px-6 py-4">${member.alamat_anggota}</td>
                    <td class="px-6 py-4">
                        <a href="<?= base_url('anggota/edit_anggota?id=') ?>${member.id_anggota}" class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs">Edit</a>
                        <button onclick="openDeleteModal(${member.id_anggota})" class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs">Hapus</button>
                    </td>
                </tr>`;
        });
    }

    
function updatePagination() {
    document.getElementById("startRange").textContent = (currentPage - 1) * perPage + 1;
    document.getElementById("endRange").textContent = Math.min(currentPage * perPage, totalEntries);
    document.getElementById("totalEntries").textContent = totalEntries;

    document.getElementById("prevBtn").disabled = currentPage === 1;
    document.getElementById("nextBtn").disabled = currentPage * perPage >= totalEntries;
}

function changePage(step) {
    let token = localStorage.getItem("token");
    if (token) {
        fetchAnggota(token, currentPage + step);
    }
}

function openDeleteModal(memberId) {
    anggotaIdDelete = memberId;
    document.getElementById("deleteModal").classList.remove("hidden");
}

document.getElementById("cancelDelete").addEventListener("click", function () {
    document.getElementById("deleteModal").classList.add("hidden");
    anggotaIdDelete = null;
});

document.getElementById("confirmDelete").addEventListener("click", async function () {
    if (anggotaIdDelete !== null) {
        await deleteAnggota(anggotaIdDelete);
        document.getElementById("deleteModal").classList.add("hidden");
        anggotaIdDelete = null;
    }
});

async function deleteAnggota(anggotaId) {
    let token = localStorage.getItem("token");
    try {
        const response = await fetch(`<?= base_url('api/members') ?>/${anggotaId}`, {
    method: "DELETE",
    headers: {
        "Authorization": `Bearer ${token}`,
        "Content-Type": "application/json"
    }
});

        if (!response.ok) {
            throw new Error("Gagal menghapus anggota");
        }

        fetchAnggota(token, 1);
    } catch (error) {
        console.error("Error deleting member:", error);
    }
}
    </script>

</body>
<?= $this->endSection() ?>

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

        <!-- Search and Filter Section -->
        <div class="mb-6 flex space-x-4">
            <input type="text" id="searchInput" placeholder="Search"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500">

            <!-- Level Filter -->
            <select id="levelFilter" class="px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">Semua Level</option>
                <option value="Kelas 1">Kelas 1</option>
                <option value="Kelas 2">Kelas 2</option>
                <option value="Kelas 3">Kelas 3</option>
                <option value="Kelas 4">Kelas 4</option>
                <option value="Kelas 5">Kelas 5</option>
                <option value="Kelas 6">Kelas 6</option>
                <option value="Guru">Guru</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>

        <!-- Table Container -->
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
           
            <div class="flex space-x-2">
                <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600" id="prevBtn">Prev</button>
                <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600" id="nextBtn">Next</button>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", async function () {
        let token = localStorage.getItem("token");

        if (token) await fetchAnggota(1);

        document.getElementById("searchInput").addEventListener("input", () => fetchAnggota(1));
        document.getElementById("levelFilter").addEventListener("change", () => fetchAnggota(1));
        document.getElementById("prevBtn").addEventListener("click", () => changePage(-1));
        document.getElementById("nextBtn").addEventListener("click", () => changePage(1));
    });

    let currentPage = 1;
    let totalEntries = 0;
    let perPage = 10;

    async function fetchAnggota(page = 1) {
        const apiBaseUrl = "https://elibrary-jelambarbaru.my.id/api/members";
        const searchQuery = document.getElementById("searchInput").value.trim();
        const selectedLevel = document.getElementById("levelFilter").value;

        let queryParams = [`page=${page}`, `per_page=${perPage}`];
        if (searchQuery) queryParams.push(`search=${encodeURIComponent(searchQuery)}`);
        if (selectedLevel) queryParams.push(`level=${encodeURIComponent(selectedLevel)}`);

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
            totalEntries = result.pagination.total_members;
            currentPage = result.pagination.current_page;
            renderTable(result.data);
            updatePagination();
        } catch (error) {
            console.error("Error fetching members:", error);
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
                        <button onclick="deleteAnggota(${member.id_anggota})" class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs">Hapus</button>
                    </td>
                </tr>`;
        });
    }

    function updatePagination() {
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    
    // Calculate total pages
    const totalPages = Math.ceil(totalEntries / perPage);
    
    // Disable/enable prev button
    prevBtn.disabled = currentPage <= 1;
    prevBtn.classList.toggle("opacity-50", currentPage <= 1);
    
    // Disable/enable next button
    nextBtn.disabled = currentPage >= totalPages;
    nextBtn.classList.toggle("opacity-50", currentPage >= totalPages);
    
    // Add page indicator
    const paginationInfo = document.createElement("div");
    paginationInfo.className = "text-sm text-gray-700";
    paginationInfo.innerHTML = `Page ${currentPage} of ${totalPages} (${totalEntries} total entries)`;
    
    // Find pagination container and update it
    const paginationContainer = document.querySelector(".bg-white.px-4.py-3.flex");
    
    // Remove existing page info if any
    const existingInfo = paginationContainer.querySelector(".text-sm.text-gray-700");
    if (existingInfo) {
        existingInfo.remove();
    }
    
    // Insert between flex container start and buttons
    paginationContainer.insertBefore(paginationInfo, document.getElementById("prevBtn").parentNode);
}

    function changePage(step) {
        fetchAnggota(currentPage + step);
    }
    </script>

</body>
<?= $this->endSection() ?>

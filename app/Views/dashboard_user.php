<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
    /* 🔹 Search Bar */
    .search-container {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 1rem;
    }

    .search-box {
        width: 100%;
        max-width: 600px;
        display: flex;
        align-items: center;
        border: 2px solid #f97316;
        border-radius: 8px;
        overflow: hidden;
    }

    .search-box input {
        flex: 1;
        padding: 10px;
        border: none;
        outline: none;
        min-width: 0;
        /* Ensure input doesn't shrink */
    }

    .search-box button {
        background: #f97316;
        padding: 10px 15px;
        border: none;
        cursor: pointer;
        color: white;
        flex-shrink: 0;
        /* Prevent button from shrinking */
    }

    /* 🔹 Filter Buttons */
    .filter-section {
        margin: 2rem auto;
        max-width: 900px;
        padding: 1rem;
    }

    .filter-title {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .filter-buttons {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        gap: 1rem;
        padding: 1rem;
        border-radius: 10px;
        background: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .filter-btn {
        padding: 10px 15px;
        font-size: 0.9rem;
        font-weight: 600;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        background-color: #4b4b4b;
        color: white;
        border: none;
        box-shadow: 2px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .filter-btn.active {
        background-color: rgb(249, 115, 22);
    }

    .filter-btn:hover {
        background-color: #f97316;
    }

    /* 🔹 Book Grid */
    .book-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
        padding: 1rem;
    }

    @media (min-width: 640px) {
        .book-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

</body>

</html>
<!-- 🔹 Search Bar -->
<div class="search-container">
    <div class="search-box shadow-md">
        <input type="text" id="search" placeholder="Cari buku..." oninput="fetchBooks()">
        <button>🔍</button>
    </div>
</div>

<body>
    <div class="filter-section">
        <p class="filter-title">Filter Buku</p>

        <!-- 🔹 Kategori Filter -->
        <p class="text-sm font-semibold text-gray-700 mb-4">Kategori</p>
        <div class="filter-buttons kategori-filters">
            <button class="filter-btn active" data-kategori="">Semua Kategori</button>

            <button class="filter-btn" data-kategori="Non Fiksi">Non Fiksi</button>
            <button class="filter-btn" data-kategori="Sains">Sains</button>
            <button class="filter-btn" data-kategori="Komik">Komik</button>
            <button class="filter-btn" data-kategori="Novel">Novel</button>
            <button class="filter-btn" data-kategori="Dongeng">Dongeng</button>
            <button class="filter-btn" data-kategori="Pelajaran">Pelajaran</button>
        </div>

        <!-- 🔹 Level Filter -->
        <p class="text-sm font-semibold text-gray-700 mt-4 mb-4">Level</p>
        <div class="filter-buttons level-filters mb-4">
            <button class="filter-btn active" data-level="">Semua Level</button>
            <button class="filter-btn" data-level="Kelas 1">Kelas 1</button>
            <button class="filter-btn" data-level="Kelas 2">Kelas 2</button>
            <button class="filter-btn" data-level="Kelas 3">Kelas 3</button>
            <button class="filter-btn" data-level="Kelas 4">Kelas 4</button>
            <button class="filter-btn" data-level="Kelas 5">Kelas 5</button>
            <button class="filter-btn" data-level="Kelas 6">Kelas 6</button>
        </div>
        <!-- 🔹 Books Container -->
        <div id="bookContainer" class="flex flex-col gap-6 px-4 py-6 ">
            <div class="loading-message">Loading books...</div>
        </div>
    </div>
    <script>
        const baseURL = "<?= base_url() ?>";
        document.addEventListener("DOMContentLoaded", function() {
            const apiBaseUrl = "<?= base_url('api/books') ?>";
            const token = localStorage.getItem("token");
            if (!token) {
                window.location.href = "<?= base_url('login-user') ?>";
                return;
            }

            const bookContainer = document.getElementById("bookContainer");
            const kategoriButtons = document.querySelectorAll(".kategori-filters .filter-btn");
            const levelButtons = document.querySelectorAll(".level-filters .filter-btn");
            const searchInput = document.getElementById("search");

            let currentKategori = "";
            let currentLevel = "";
            let currentPage = 1;
            let perPage = 10;

            // Add pagination controls
            function createPaginationControls(pagination) {
                const paginationDiv = document.createElement('div');
                paginationDiv.className = 'flex justify-center gap-4 mt-8';

                // Previous page button
                if (pagination.prev_page) {
                    const prevButton = document.createElement('button');
                    prevButton.className = 'px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300';
                    prevButton.textContent = 'Previous';
                    prevButton.onclick = () => {
                        currentPage = pagination.prev_page;
                        fetchBooks();
                    };
                    paginationDiv.appendChild(prevButton);
                }

                // Page info
                const pageInfo = document.createElement('span');
                pageInfo.className = 'px-4 py-2 text-gray-700';
                pageInfo.textContent = `Page ${pagination.current_page} of ${pagination.total_pages}`;
                paginationDiv.appendChild(pageInfo);

                // Next page button
                if (pagination.next_page) {
                    const nextButton = document.createElement('button');
                    nextButton.className = 'px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300';
                    nextButton.textContent = 'Next';
                    nextButton.onclick = () => {
                        currentPage = pagination.next_page;
                        fetchBooks();
                    };
                    paginationDiv.appendChild(nextButton);
                }

                return paginationDiv;
            }

            window.fetchBooks = function() {
                let searchQuery = searchInput.value.trim();
                let url = "http://localhost:8080/api/books";

                // Add query parameters
                const params = new URLSearchParams();
                params.append('page', currentPage);
                params.append('per_page', perPage);

                if (searchQuery) params.append('search', searchQuery);
                if (currentKategori) params.append('kategori', currentKategori);
                if (currentLevel) params.append('level', currentLevel);

                // Add parameters to URL
                url += `?${params.toString()}`;

                console.log("Fetching books from URL:", url);

                fetch(url, {
                        method: "GET",
                        headers: {
                            "Authorization": `Bearer ${token}`, // Ensure this is the correct token format
                            "Content-Type": "application/json",
                            "Accept": "application/json" // Explicitly request JSON
                        },
                    })
                    .then(response => {
                        console.log("Response status:", response.status);

                        // Log the full response for debugging
                        return response.json().then(data => {
                            if (!response.ok) {
                                console.error("Error response:", data);
                                throw new Error(data.message || 'Failed to fetch books');
                            }
                            return data;
                        });
                    })
                    .then(data => {
                        console.log("Received book data:", data);

                        // Rest of your existing rendering logic
                        bookContainer.innerHTML = "";

                        if (!data || !data.data.length) {
                            bookContainer.innerHTML = '<div class="text-center text-gray-500">No books found</div>';
                            return;
                        }

                        data.data.forEach(book => {
                            const bookCard = `
                <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col sm:flex-row gap-4 border border-gray-200">
                    <img src="${book.sampul_url || '/api/placeholder/120/160'}" alt="${book.judul}" 
                         class="w-32 h-40 object-cover rounded-md shadow-md">
                    <div class="flex-1">
                        <h3 class="font-bold text-lg mb-2">${book.judul}</h3>
                        <p class="text-sm text-gray-600 mb-1">
                            ${book.pengarang ? book.pengarang : 'Unknown Author'}${book.penerbit ? `. ${book.penerbit}` : ''}${book.tahun && book.tahun !== '0000' ? `. ${book.tahun}` : ''}
                        </p>
                        <p class="text-sm text-gray-500 mb-2">Kategori: ${book.kategori || 'Uncategorized'}</p>
                        <p class="text-sm text-gray-500 mb-2">Level: ${book.level || 'No level'}</p>
                        <p class="text-sm text-gray-600 mb-4">${book.sinopsis || "No synopsis available"}</p>
                        <p class="text-xs text-gray-400 mb-2">ISBN: ${book.isbn || 'N/A'}</p>
                        <div class="flex gap-2">
                        ${book.file_ebook_url ? 
    (() => {
        const urlParts = book.file_ebook_url.split('/');
        const filename = urlParts[urlParts.length - 1];
        return `<a href="${baseURL}pdf/viewIframe/${filename}" target="_blank" 
            class="inline-flex items-center bg-orange-500 text-white px-4 py-1 rounded-full text-sm shadow-md hover:bg-orange-600 transition-colors">
                <span class="mr-1">📚</span> Baca E-Book
            </a>`;
    })() : 
    ''
}



                            ${book.buku_fisik === "Y" ? 
                                `<button class="inline-flex items-center bg-white border border-green-500 text-green-500 px-4 py-1 rounded-full text-sm shadow-md">
                                    <span class="mr-1">📖</span> Buku Fisik
                                </button>` : 
                                ''
                            }
                        </div>
                    </div>
                </div>
            `;
                            bookContainer.innerHTML += bookCard;
                        });

                        // Add pagination controls
                        if (data.pagination) {
                            bookContainer.appendChild(createPaginationControls(data.pagination));
                        }
                    })
                    .catch(error => {
                        console.error("Full error details:", error);
                        console.log("Token:", token);
                        bookContainer.innerHTML = `<div class="text-center text-red-500">Error loading books: ${error.message}</div>`;
                    });
            };

            // Handle Kategori Filter
            kategoriButtons.forEach(button => {
                button.addEventListener("click", function() {
                    kategoriButtons.forEach(btn => btn.classList.remove("active"));
                    this.classList.add("active");
                    currentKategori = this.getAttribute("data-kategori");
                    currentPage = 1; // Reset to first page when filtering
                    fetchBooks();
                });
            });

            // Handle Level Filter
            levelButtons.forEach(button => {
                button.addEventListener("click", function() {
                    levelButtons.forEach(btn => btn.classList.remove("active"));
                    this.classList.add("active");
                    currentLevel = this.getAttribute("data-level");
                    currentPage = 1; // Reset to first page when filtering
                    fetchBooks();
                });
            });

            fetchBooks();
        });
    </script>

</body>

</html>

<?= $this->endSection() ?>
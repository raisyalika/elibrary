<?= $this->extend('layouts/main_admin') ?>
<?= $this->section('content') ?>

<body class="bg-gray-100 flex flex-col w-full h-full">
    <!-- Main Content - Modified -->
    <div class="flex-1 p-8">
        <!-- Header with name and title -->
        <div class="flex justify-between items-center mb-8 p-4">
            <h1 class="text-2xl font-bold bg-gradient-to-b from-[#EC2C5A] to-[#FA7C54] bg-clip-text text-transparent">Edit Buku</h1>
            <div class="flex items-center space-x-4">
                <span id="userName" class="text-gray-600"></span>
            </div>
        </div>

        <!-- Form Content -->
        <div class="bg-white rounded-lg shadow-md p-6 max-w-4xl mx-auto">
            <form class="space-y-6" id="bookForm" enctype="multipart/form-data">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sampul Buku</label>
                    <div class="mb-2">
                        <img id="coverPreview" src="/api/placeholder/120/120" alt="Cover Preview" class="w-32 h-32 object-cover rounded-md">
                    </div>
                    <input type="file" id="sampul" name="cover" accept="image/*" class="w-full p-2 border rounded-md text-gray-700">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                    <input type="text" id="judul" class="w-full p-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Masukkan Judul">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">ISBN</label>
                    <input type="text" id="isbn" class="w-full p-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Masukkan ISBN">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pengarang</label>
                    <input type="text" id="pengarang" class="w-full p-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Masukkan Nama Pengarang">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penerbit</label>
                    <input type="text" id="penerbit" class="w-full p-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Masukkan Nama Penerbit">
                </div>

                <!-- Tahun Terbit now as a number input -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Terbit</label>
                    <input type="number" id="tahun" class="w-full p-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Masukkan Tahun" min="1900" max="2099">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pengadaan</label>
                    <input type="date" id="tanggal_pengadaan" class="w-full p-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <div class="space-y-2">
                        <label class="inline-flex items-center">
                            <input type="radio" name="category" value="non fiksi" class="text-red-500 focus:ring-red-500">
                            <span class="ml-2">Non Fiksi</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                            <input type="radio" name="category" value="dongeng" class="text-red-500 focus:ring-red-500">
                            <span class="ml-2">Dongeng</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                            <input type="radio" name="category" value="pelajaran" class="text-red-500 focus:ring-red-500">
                            <span class="ml-2">Pelajaran</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                            <input type="radio" name="category" value="sains" class="text-red-500 focus:ring-red-500">
                            <span class="ml-2">Sains</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                            <input type="radio" name="category" value="komik" class="text-red-500 focus:ring-red-500">
                            <span class="ml-2">Komik</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                            <input type="radio" name="category" value="novel" class="text-red-500 focus:ring-red-500">
                            <span class="ml-2">Novel</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                            <input type="radio" name="category" value="lainnya" class="text-red-500 focus:ring-red-500">
                            <span class="ml-2">Lainnya</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Level</label>
                    <select id="level" class="w-full p-2 border rounded-md">
                        <option value="Kelas 1">Kelas 1</option>
                        <option value="Kelas 2">Kelas 2</option>
                        <option value="Kelas 3">Kelas 3</option>
                        <option value="Kelas 4">Kelas 4</option>
                        <option value="Kelas 6">Kelas 6</option>
                        <option value="Kelas 5">Kelas 5</option>
                        <option value="Guru">Guru</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sinopsis</label>
                    <textarea id="sinopsis" class="w-full p-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500" rows="4" placeholder="Masukkan Sinopsis"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Format</label>
                    <div class="space-y-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" value="E-Book" class="text-red-500 focus:ring-red-500">
                            <span class="ml-2">E-Book</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                            <input type="checkbox" value="Buku Fisik" class="text-red-500 focus:ring-red-500">
                            <span class="ml-2">Buku Fisik</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload E-Book</label>
                    <div id="ebookPreview" class="mb-2"></div>
                    <input type="file" id="ebook" name="pdf" accept=".pdf" class="w-full p-2 border rounded-md text-gray-700">
                    <p class="mt-1 text-sm text-gray-500">Format: .pdf</p>
                </div>

                <div class="pt-4 flex flex-col sm:flex-row sm:justify-end sm:space-x-4">
                    <a href="<?= base_url('buku') ?>" class="flex-1 text-center border border-gray-300 text-gray-700 text-sm font-medium rounded-lg py-1.5 hover:bg-gray-50 hover:opacity-90 transition">
                        Batal
                    </a>
                    <button id="simpanButton" type="submit" class="flex-1 bg-gradient-to-r from-[#FA7C54] to-[#EC2C5A] text-white text-sm py-1.5 rounded-lg hover:opacity-90 transition">
                        Simpan
                    </button>

                </div>
            </form>
        </div>
    </div>
</body>

<script>
    const baseURL = "<?= base_url() ?>";
    document.addEventListener("DOMContentLoaded", function() {
        let userData = localStorage.getItem("user");
        let token = localStorage.getItem("token");
        const urlParams = new URLSearchParams(window.location.search);
        const bookId = urlParams.get("id");

        if (userData) {
            let user = JSON.parse(userData);
            document.getElementById("userName").textContent = user.name;
        }

        if (token && bookId) {
            fetchBook(bookId, token);
        } else {
            console.warn("Token atau Book ID tidak ditemukan.");
        }

        document.getElementById("bookForm").addEventListener("submit", function(event) {
            updateBook(event, bookId, token);
        });
    });

    async function fetchBook(bookId, token) {
        try {
            const response = await fetch(`${baseURL}api/books/${bookId}`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const result = await response.json();
            populateForm(result);

        } catch (error) {
            console.error("🚨 Error fetching book data:", error);
            alert("❌ Gagal mengambil data buku.");
        }
    }

    function populateForm(data) {
        console.log("📖 Populating Form with Data:", data);

        document.getElementById('judul').value = data.judul || "";
        document.getElementById('isbn').value = data.isbn || "";
        document.getElementById('pengarang').value = data.pengarang || "";
        document.getElementById('penerbit').value = data.penerbit || "";
        // Simply assign the year (e.g., "2025")
        document.getElementById('tahun').value = data.tahun || "";
        document.getElementById('tanggal_pengadaan').value = data.tgl_pengadaan || "";
        document.getElementById('sinopsis').value = data.sinopsis || "";

        // Handle kategori (category) selection (make sure to match the radio button value)
        if (data.kategori && data.kategori.trim() !== "") {
            // Adjust case if necessary to match the radio input values
            const kategoriValue = data.kategori.toLowerCase();
            const kategoriRadio = document.querySelector(`input[name="category"][value="${kategoriValue}"]`);
            if (kategoriRadio) kategoriRadio.checked = true;
        }

        // Handle Sampul (Cover Image)
        const coverPreview = document.getElementById("coverPreview");
        if (data.sampul_url) {
            coverPreview.src = data.sampul_url;
        } else {
            coverPreview.src = "/api/placeholder/120/120";
        }

        // Handle E-Book Link
        const ebookPreview = document.getElementById("ebookPreview");
        ebookPreview.innerHTML = "";
        if (data.file_ebook_url) {
            const ebookLink = document.createElement("a");
            ebookLink.href = data.file_ebook_url;
            ebookLink.textContent = "📄 Lihat E-Book";
            ebookLink.target = "_blank";
            ebookLink.className = "text-blue-600 hover:text-blue-800 underline";
            ebookPreview.appendChild(ebookLink);
        }

        // Handle format checkboxes (using "Y" as true)
        if (data.ebook === "Y") {
            document.querySelector(`input[type="checkbox"][value="E-Book"]`).checked = true;
        }
        if (data.buku_fisik === "Y") {
            document.querySelector(`input[type="checkbox"][value="Buku Fisik"]`).checked = true;
        }
    }

    async function updateBook(event, bookId, token) {
        event.preventDefault();

        try {
            // Handle file uploads if files are selected
            const coverFile = document.getElementById('sampul').files[0];
            const ebookFile = document.getElementById('ebook').files[0];

            const formData = new FormData();

            // Add regular form data
            formData.append('judul', document.getElementById("judul").value.trim());
            formData.append('isbn', document.getElementById("isbn").value.trim());
            formData.append('pengarang', document.getElementById("pengarang").value.trim());
            formData.append('penerbit', document.getElementById("penerbit").value.trim());
            formData.append('tahun', document.getElementById("tahun").value.trim());
            formData.append('tanggal_pengadaan', document.getElementById("tanggal_pengadaan").value.trim());
            formData.append('kategori', document.querySelector("input[name='category']:checked")?.value || "");
            formData.append('level', document.getElementById("level").value);
            formData.append('sinopsis', document.getElementById("sinopsis").value.trim());

            // Add selected formats as a JSON string
            const selectedFormats = Array.from(document.querySelectorAll("input[type='checkbox']:checked")).map(cb => cb.value);
            formData.append('format', JSON.stringify(selectedFormats));

            // Update the main book data
            const bookResponse = await fetch(`${baseURL}api/books/${bookId}`, {
                method: 'PUT',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(Object.fromEntries(formData))
            });

            if (!bookResponse.ok) {
                const result = await bookResponse.json();
                throw new Error(result.message || 'Failed to update book data');
            }

            // Handle cover upload if a new file is selected
            if (coverFile) {
                const coverFormData = new FormData();
                coverFormData.append('cover', coverFile);

                const coverResponse = await fetch(`${baseURL}api/books/${bookId}/upload-cover`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`
                    },
                    body: coverFormData
                });

                if (!coverResponse.ok) {
                    throw new Error('Failed to upload cover image');
                }
            }

            // Handle PDF upload if a new file is selected
            if (ebookFile) {
                const pdfFormData = new FormData();
                pdfFormData.append('pdf', ebookFile);

                const pdfResponse = await fetch(`${baseURL}api/books/${bookId}/upload-pdf`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`
                    },
                    body: pdfFormData
                });

                if (!pdfResponse.ok) {
                    throw new Error('Failed to upload PDF file');
                }
            }

            alert("✅ Buku berhasil diperbarui!");
            window.location.href = baseURL + 'buku';

        } catch (error) {
            console.error("🚨 Error updating book:", error);
            alert("❌ Terjadi kesalahan: " + error.message);
        }
    }
</script>

<?= $this->endSection() ?>
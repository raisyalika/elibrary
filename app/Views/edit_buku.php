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
                <form class="space-y-6" id="bookForm">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sampul Buku*</label>
                        <input type="file" id="sampul" class="w-full p-2 border rounded-md text-gray-700">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul*</label>
                        <input type="text" id="judul" class="w-full p-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Masukkan Judul">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">ISBN</label>
                        <input type="text" id="isbn" class="w-full p-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Masukkan ISBN">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pengarang*</label>
                        <input type="text" id="pengarang" class="w-full p-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Masukkan Nama Pengarang">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penerbit*</label>
                        <input type="text" id="penerbit" class="w-full p-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Masukkan Nama Penerbit">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Terbit*</label>
                        <input type="date" id="tahun" class="w-full p-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pengadaan*</label>
                        <input type="date" id="tanggal_pengadaan" class="w-full p-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori*</label>
                        <div class="space-y-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="category" value="non_fiksi" class="text-red-500 focus:ring-red-500">
                                <span class="ml-2">Non Fiksi</span>
                            </label>
                            <label class="inline-flex items-center ml-6">
                                <input type="radio" name="category" value="dongeng" class="text-red-500 focus:ring-red-500">
                                <span class="ml-2">Dongeng</span>
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
                        </div>
                    </div>
                    <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Level*</label>
                    <select id="level" class="w-full p-2 border rounded-md">
                        <option value="Kelas 1">Kelas 1</option>
                        <option value="Kelas 2">Kelas 2</option>
                        <option value="Kelas 3">Kelas 3</option>
                        <option value="Kelas 4">Kelas 4</option>
                        <option value="Kelas 6">Kelas 6</option>
                        <option value="Kelas 5">Kelas 5</option>
                        <option value="Guru">Guru</option>
                    </select>
                </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sinopsis</label>
                        <textarea id="sinopsis" class="w-full p-2 border rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500" rows="4" placeholder="Masukkan Sinopsis"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Format*</label>
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
                        <input type="file" id="ebook" class="w-full p-2 border rounded-md text-gray-700">
                        <p class="mt-1 text-sm text-gray-500">Format: .pdf</p>
                    </div>

                    <div class="pt-4">
                        <button id="simpanButton" type="submit" class="w-full py-2 px-4 bg-gradient-to-b from-[#FA7C54] to-[#EC2C5A] text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            Simpan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>


<script>
  document.addEventListener("DOMContentLoaded", function () {
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

    // Event listener untuk form submit
    document.getElementById("bookForm").addEventListener("submit", function (event) {
        updateBook(event, bookId, token);
    });
});

async function fetchBook(bookId, token) {
    try {
        const response = await fetch(`http://localhost:8080/api/books/${bookId}`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json'
            }
        });

        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

        const result = await response.json();
        console.log(result)
        populateForm(result);

    } catch (error) {
        console.error("Error fetching book data:", error);
    }
}

function populateForm(data) {
    document.getElementById('judul').value = data.judul || "";
    document.getElementById('isbn').value = data.isbn || "";
    document.getElementById('pengarang').value = data.pengarang || "";
    document.getElementById('level').value = data.level || "";
    document.getElementById('penerbit').value = data.penerbit || "";
    document.getElementById('tahun_terbit').value = data.tahun_terbit || "";
    document.getElementById('tanggal_pengadaan').value = data.tanggal_pengadaan || "";
    document.getElementById('sinopsis').value = data.sinopsis || "";
    console.log(data)
    const kategori = document.querySelector(`input[name="category"][value="${data.kategori}"]`);
    if (kategori) kategori.checked = true;

    // if (data.format) {
    //     data.format.split(",").forEach(format => {
    //         const checkbox = document.querySelector(`input[type="checkbox"][value="${format.trim()}"]`);
    //         if (checkbox) checkbox.checked = true;
    //     });
    // }
}

async function updateBook(event, bookId, token) {
    event.preventDefault(); // Mencegah form submit default
    
    console.log("bookid",bookId)
    console.log("token",token)

     event.preventDefault(); // Mencegah reload halaman saat submit

    const bookData = {
        judul: document.getElementById("judul").value.trim(),
        isbn: document.getElementById("isbn").value.trim(),
        pengarang: document.getElementById("pengarang").value.trim(),
        penerbit: document.getElementById("penerbit").value.trim(),
        tahun: document.getElementById("tahun").value.trim(),
        tanggal_pengadaan: document.getElementById("tanggal_pengadaan").value.trim(),
        kategori: document.querySelector("input[name='category']:checked")?.value || "", // Mengambil kategori yang dipilih
        sinopsis: document.getElementById("sinopsis").value.trim(),
        format: Array.from(document.querySelectorAll("input[type='checkbox']:checked")).map(cb => cb.value), // Mengambil format buku (E-Book / Buku Fisik)
        // sampul: document.getElementById("sampul").files[0] || null, // Mengambil file sampul jika ada
        // ebook: document.getElementById("ebook").files[0] || null // Mengambil file e-book jika ada
    };

    console.log(bookData);

    try {
        console.log("token",token)
        const response = await fetch(`http://localhost:8080/api/books/${bookId}`,{
            method: 'PUT',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(bookData)
        });
        const result = await response.json();
        if (response.ok){
            alert("Buku berhasil diUpdate!");
            document.getElementById('bookForm').reset();
            window.location.href = "<?= base_url('/beranda') ?>";

        } else{
            alert("Gagal menyimpan buku. Error: " + result.message);
        }
    } catch (error) {
        console.log("Error:", error)
        alert("Terjadi kesalahan saat mengupdate data.")
        
    }
}

</script>

<?= $this->endSection() ?>

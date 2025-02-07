<?= $this->extend('layouts/main_admin') ?>
<?= $this->section('content') ?>

<body class="bg-gray-100 flex flex-col w-full h-full">
    <div class="flex-1 p-8">
        <div class="flex justify-between items-center mb-8 p-4">
            <h1 class="text-2xl font-bold bg-gradient-to-b from-[#EC2C5A] to-[#FA7C54] bg-clip-text text-transparent">Tambah Buku</h1>
            <div class="flex items-center space-x-4">
                <span id="userName" class="text-gray-600"></span>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 max-w-4xl mx-auto">
            <form id="bookForm" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sampul Buku*</label>
                    <input type="file" id="sampul" class="w-full p-2 border rounded-md" accept="image/*">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul*</label>
                    <input type="text" id="judul" class="w-full p-2 border rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">ISBN</label>
                    <input type="text" id="isbn" class="w-full p-2 border rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pengarang*</label>
                    <input type="text" id="pengarang" class="w-full p-2 border rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penerbit*</label>
                    <input type="text" id="penerbit" class="w-full p-2 border rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Terbit*</label>
                    <input type="date" id="tahun" class="w-full p-2 border rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pengadaan*</label>
                    <input type="date" id="tanggal_pengadaan" class="w-full p-2 border rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori*</label>
                    <select id="kategori" class="w-full p-2 border rounded-md">
                        <option value="Kelas 1">Kelas 1</option>
                        <option value="Kelas 2">Kelas 2</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sinopsis</label>
                    <textarea id="sinopsis" class="w-full p-2 border rounded-md" rows="4"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Format*</label>
                    <label><input type="checkbox" id="formatEbook" value="E-Book"> E-Book</label>
                    <label><input type="checkbox" id="formatFisik" value="Buku Fisik"> Buku Fisik</label>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload E-Book</label>
                    <input type="file" id="ebook" class="w-full p-2 border rounded-md" accept="application/pdf">
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full py-2 px-4 bg-red-500 text-white rounded-md hover:bg-red-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let userData = localStorage.getItem("user");
        if (userData) {
            let user = JSON.parse(userData);
            document.getElementById('userName').textContent = user.name;
        }
    });

    document.getElementById("bookForm").addEventListener("submit", async function(event) {
        event.preventDefault();
        
        const token = localStorage.getItem("token");
        if (!token) {
            alert("Token tidak ditemukan, silakan login terlebih dahulu.");
            return;
        }
        
        let formData = new FormData();
        formData.append("judul", document.getElementById("judul").value);
        formData.append("isbn", document.getElementById("isbn").value);
        formData.append("pengarang", document.getElementById("pengarang").value);
        formData.append("penerbit", document.getElementById("penerbit").value);
        formData.append("tahun", document.getElementById("tahun").value);
        formData.append("tanggal_pengadaan", document.getElementById("tanggal_pengadaan").value);
        formData.append("kategori", document.getElementById("kategori").value);
        formData.append("sinopsis", document.getElementById("sinopsis").value);
        
        let format = [];
        if (document.getElementById("formatEbook").checked) format.push("E-Book");
        if (document.getElementById("formatFisik").checked) format.push("Buku Fisik");
        formData.append("format", format.join(", "));
        
        let sampulFile = document.getElementById("sampul").files[0];
        let ebookFile = document.getElementById("ebook").files[0];
        if (sampulFile) formData.append("sampul", sampulFile);
        if (ebookFile) formData.append("ebook", ebookFile);
        
        try {
            const response = await fetch("http://localhost:8080/api/books", {
                method: "POST",
                headers: { "Authorization": `Bearer ${token}` },
                body: formData
            });
            
            const result = await response.json();
            if (response.ok) {
                alert("Buku berhasil ditambahkan!");
                document.getElementById("bookForm").reset();
            } else {
                alert("Gagal menambahkan buku: " + result.message);
            }
        } catch (error) {
            console.error("Error:", error);
            alert("Terjadi kesalahan saat mengirim data.");
        }
    });
</script>

<?= $this->endSection() ?>
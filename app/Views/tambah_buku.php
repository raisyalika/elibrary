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
                    <input  type="file" id="sampul" class="w-full p-2 border rounded-md" accept="image/*">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul*</label>
                    <input required type="text" id="judul" class="w-full p-2 border rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">ISBN</label>
                    <input required type="text" id="isbn" class="w-full p-2 border rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pengarang*</label>
                    <input required type="text" id="pengarang" class="w-full p-2 border rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penerbit*</label>
                    <input required type="text" id="penerbit" class="w-full p-2 border rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Terbit*</label>
                    <input required type="date" id="tahun" class="w-full p-2 border rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pengadaan*</label>
                    <input required type="date" id="tanggal_pengadaan" class="w-full p-2 border rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori*</label>
                    <select required id="kategori" class="w-full p-2 border rounded-md">
                        <option value="non_fiksi">Non Fiksi</option>
                        <option value="dongeng">Dongeng</option>
                        <option value="sains">Sains</option>
                        <option value="komik">Komik</option>
                        <option value="Novel">Novel</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Level*</label>
                    <select required id="level" class="w-full p-2 border rounded-md">
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
                    <textarea required id="sinopsis" class="w-full p-2 border rounded-md" rows="4"></textarea>
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
    document.addEventListener("DOMContentLoaded", function () {
        let userData = localStorage.getItem("user");
        if (userData) {
            let user = JSON.parse(userData);
            document.getElementById('userName').textContent = user.name;
        }
    });

    document.getElementById("bookForm").addEventListener("submit", async function (event) {
        event.preventDefault();

        const token = localStorage.getItem("token");
        if (!token) {
            alert("Token tidak ditemukan, silakan login terlebih dahulu.");
            return;
        }

        // Ambil nilai dari input form
        const bookData = {
            judul: document.getElementById("judul").value.trim(),
            isbn: document.getElementById("isbn").value.trim(),
            pengarang: document.getElementById("pengarang").value.trim(),
            penerbit: document.getElementById("penerbit").value.trim(),
            tahun: document.getElementById("tahun").value.trim(),
            tgl_pengadaan: document.getElementById("tanggal_pengadaan").value.trim(),
            kategori: document.getElementById("kategori").value.trim(),
            level: document.getElementById("level").value.trim(),
            sinopsis: document.getElementById("sinopsis").value.trim(),
            ebook: document.getElementById("formatEbook").checked ? "Y" : "N",
            buku_fisik: document.getElementById("formatFisik").checked ? "Y" : "N"
        };

        try {
            // 🔹 Step 1: Create the book
            const createResponse = await fetch("http://localhost:8080/api/books", {
                method: "POST",
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(bookData)
            });

            const createdBook = await createResponse.json();
            console.log("📚 Book Created:", createdBook);

            if (!createResponse.ok) {
                alert("❌ Gagal menambahkan buku: " + JSON.stringify(createdBook.messages));
                return;
            }

            const bookId = createdBook.id;

            // 🔹 Step 2: Upload Cover (if selected)
            const sampulFile = document.getElementById("sampul").files[0];
            if (sampulFile) {
                const coverFormData = new FormData();
                coverFormData.append("cover", sampulFile);

                const coverResponse = await fetch(`http://localhost:8080/api/books/${bookId}/upload-cover`, {
                    method: "POST",
                    headers: { "Authorization": `Bearer ${token}` },
                    body: coverFormData
                });

                const coverResult = await coverResponse.json();
                console.log("🖼 Cover Upload Result:", coverResult);

                if (!coverResponse.ok) {
                    alert("⚠️ Gagal mengupload sampul buku: " + JSON.stringify(coverResult));
                }
            }

            // 🔹 Step 3: Upload PDF (if selected)
            const ebookFile = document.getElementById("ebook").files[0];
            if (ebookFile) {
                const pdfFormData = new FormData();
                pdfFormData.append("pdf", ebookFile);

                const pdfResponse = await fetch(`http://localhost:8080/api/books/${bookId}/upload-pdf`, {
                    method: "POST",
                    headers: { "Authorization": `Bearer ${token}` },
                    body: pdfFormData
                });

                const pdfResult = await pdfResponse.json();
                console.log("📄 PDF Upload Result:", pdfResult);

                if (!pdfResponse.ok) {
                    alert("⚠️ Gagal mengupload file e-book: " + JSON.stringify(pdfResult));
                }
            }

            alert("✅ Buku berhasil ditambahkan!");
            document.getElementById("bookForm").reset();
            window.location.href = "<?= base_url('/buku') ?>";

        } catch (error) {
            console.error("🚨 Error:", error);
            alert("❌ Terjadi kesalahan saat mengirim data.");
        }
    });
</script>


<?= $this->endSection() ?>
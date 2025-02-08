<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>


<body class="flex flex-col min-h-screen bg-gray-50">
    <!-- Header -->
    

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto">
            <!-- Profile Picture Section -->
            <div class="flex flex-col items-center mb-8">
                <div class="relative">
                    <img id="profilePicture" 
                        src="assets/img/profile.jpg" 
                        alt="Profile Picture" 
                        class="w-32 h-32 rounded-full object-cover mb-4 border border-gray-300 shadow-md">
                    
                    <!-- Edit Profile Picture Button -->
                    <button id="uploadPictureBtn" 
                            class="absolute bottom-4 right-0 bg-orange-500 text-white p-2 rounded-full hover:bg-orange-600 shadow-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </button>
                </div>
             
            </div>

            <!-- Profile Form -->
            <form id="profileForm" class="space-y-6">
                <div>
                    <label for="memberId" class="block text-sm font-medium text-gray-700">ID Anggota</label>
                    <input type="text" id="memberId" name="memberId" class="block w-full rounded-md border-gray-300 shadow-sm p-2 bg-gray-100" readonly>
                </div>

                <div>
                    <label for="fullName" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" id="fullName" name="fullName" class="block w-full rounded-md border-gray-300 shadow-sm p-2">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="block w-full rounded-md border-gray-300 shadow-sm p-2">
                </div>

                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                    <select id="gender" name="gender" class="block w-full rounded-md border-gray-300 shadow-sm p-2">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div>
                    <label for="level" class="block text-sm font-medium text-gray-700">Level</label>
                    <select id="level" name="level" class="block w-full rounded-md border-gray-300 shadow-sm p-2">
                        <option value="Kelas 1">Kelas 1</option>
                        <option value="Kelas 2">Kelas 2</option>
                        <option value="Kelas 3">Kelas 3</option>
                        <option value="Kelas 4">Kelas 4</option>
                        <option value="Kelas 5">Kelas 5</option>
                        <option value="Kelas 6">Kelas 6</option>
                    </select>
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea id="address" name="address" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm p-2"></textarea>
                </div>

                <button type="button" id="saveProfileBtn" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow-md mt-2">
                    Simpan
                </button>
            </form>
        </div>
    </main>

   
</body>

<script>
document.addEventListener("DOMContentLoaded", async function () {
    const token = localStorage.getItem("token");
    const user = JSON.parse(localStorage.getItem("user"));

    if (!token || !user || !user.id) {
        window.location.href = "<?= base_url('login_user') ?>";
        return;
    }

    const apiUrl = `http://localhost:8080/api/members/${user.id}`;

    try {
        const response = await fetch(apiUrl, {
            method: "GET",
            headers: { "Authorization": `Bearer ${token}`, "Content-Type": "application/json" }
        });

        if (!response.ok) throw new Error("Failed to fetch user data");

        const data = await response.json();

        document.getElementById("memberId").value = data.id_anggota;
        document.getElementById("fullName").value = data.nama_anggota;
        document.getElementById("password").value = "********";
        document.getElementById("gender").value = data.jk_anggota;
        document.getElementById("level").value = data.level_anggota;
        document.getElementById("address").value = data.alamat_anggota;
        if (data.foto_url) document.getElementById("profilePicture").src = data.foto_url;

    } catch (error) {
        alert("Gagal mengambil data profil.");
    }
});

// Handle Profile Picture Upload
document.getElementById("uploadPictureBtn").addEventListener("click", function () {
    const input = document.createElement("input");
    input.type = "file";
    input.accept = "image/*";

    input.onchange = async function (event) {
        const file = event.target.files[0];
        if (!file) return;

        const formData = new FormData();
        formData.append("profilePicture", file);

        const user = JSON.parse(localStorage.getItem("user"));
        const token = localStorage.getItem("token");

        const response = await fetch(`http://localhost:8080/api/members/${user.id}/upload-profile-picture`, {
            method: "POST",
            headers: { "Authorization": `Bearer ${token}` },
            body: formData
        });

        const data = await response.json();
        if (data.foto_url) document.getElementById("profilePicture").src = data.foto_url;
    };

    input.click();
});

// Handle Profile Update
document.getElementById("saveProfileBtn").addEventListener("click", async function () {
    const user = JSON.parse(localStorage.getItem("user"));
    const token = localStorage.getItem("token");

    const updatedData = {
        nama_anggota: document.getElementById("fullName").value,
        jk_anggota: document.getElementById("gender").value,
        level_anggota: document.getElementById("level").value,
        alamat_anggota: document.getElementById("address").value
    };

    await fetch(`http://localhost:8080/api/members/${user.id}`, {
        method: "PUT",
        headers: { "Authorization": `Bearer ${token}`, "Content-Type": "application/json" },
        body: JSON.stringify(updatedData)
    });

    alert("Profil berhasil diperbarui!");
});
</script>

<?= $this->endSection() ?>
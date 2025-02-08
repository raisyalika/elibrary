<?= $this->extend('layouts/main_admin') ?>
<?= $this->section('content') ?>

<body class="bg-gray-100 flex flex-col w-full h-full">
    <div class="flex-1 p-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8 p-4 rounded-lg">
            <h1 class="text-2xl font-bold bg-gradient-to-b from-[#EC2C5A] to-[#FA7C54] bg-clip-text text-transparent">Tambah Anggota</h1>
        </div>

        <!-- Add Member Form -->
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-3xl mx-auto">
            <form id="anggotaForm" class="space-y-6">
                <!-- Profile Photo Upload -->
                <div class="flex flex-col items-center">
                    <div class="relative">
                        <img id="profilePicturePreview" src="assets/img/profile.jpg" class="w-32 h-32 rounded-full object-cover mb-4 border border-gray-300 shadow-md">
                    </div>
                    <input type="file" id="profilePicture" accept="image/*" class="hidden">
                    <button type="button" id="uploadPictureBtn" class="bg-orange-500 text-white px-4 py-2 rounded-lg shadow-md mt-2">
                        Pilih Foto Profil
                    </button>
                </div>

                <!-- Form Fields -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input id="nama_lengkap" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Username</label>
                        <input id="username" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <div class="mt-2 space-y-2">
                            <div class="flex items-center">
                                <input type="radio" name="gender" value="P" class="h-4 w-4 text-red-600 border-gray-300">
                                <label class="ml-3 block text-sm text-gray-700">Perempuan</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" name="gender" value="L" class="h-4 w-4 text-red-600 border-gray-300">
                                <label class="ml-3 block text-sm text-gray-700">Laki-laki</label>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Level</label>
                        <select id="level" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="Kelas 1">Kelas 1</option>
                            <option value="Kelas 2">Kelas 2</option>
                            <option value="Kelas 3">Kelas 3</option>
                            <option value="Kelas 4">Kelas 4</option>
                            <option value="Kelas 5">Kelas 5</option>
                            <option value="Kelas 6">Kelas 6</option>
                            <option value="Guru">Guru</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea id="alamat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" rows="3"></textarea>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" id="submitBtn" class="bg-gradient-to-b from-[#FA7C54] to-[#EC2C5A] text-white px-6 py-2 rounded-lg hover:opacity-90 transition-opacity">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
<script>
document.addEventListener("DOMContentLoaded", function () {
    console.log("🔹 Script loaded: Ready to handle user creation");

    const token = localStorage.getItem("token");
    let newMemberId = null;

    if (!token) {
        alert("Unauthorized! Please log in.");
        window.location.href = "<?= base_url('login-admin') ?>";
        return;
    }

    document.getElementById("uploadPictureBtn").addEventListener("click", () => {
        document.getElementById("profilePicture").click();
    });

    document.getElementById("profilePicture").addEventListener("change", function (event) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById("profilePicturePreview").src = e.target.result;
        };
        reader.readAsDataURL(file);
    });

    document.getElementById("anggotaForm").addEventListener("submit", async function (event) {
        event.preventDefault();
        console.log("📡 Submitting user data...");

        const anggotaData = {
            nama_anggota: document.getElementById("nama_lengkap").value,
            username: document.getElementById("username").value,
            password: document.getElementById("password").value,
            jk_anggota: document.querySelector('input[name="gender"]:checked')?.value,
            level_anggota: document.getElementById("level").value,
            alamat_anggota: document.getElementById("alamat").value
        };

        try {
            console.log("📡 Sending request to create user:", anggotaData);
            const createResponse = await fetch("http://localhost:8080/api/members", {
                method: "POST",
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(anggotaData)
            });

            console.log("📩 Response received:", createResponse);
            const createData = await createResponse.json();
            console.log("✅ User creation response:", createData);

            if (!createResponse.ok) {
                // If there's a validation error, show an alert with the details
                if (createData.messages) {
                    let errorMsg = "❌ Gagal menambahkan anggota:\n";
                    for (const [field, message] of Object.entries(createData.messages)) {
                        console.error(`🚨 Error in ${field}:`, message);
                        errorMsg += `- ${message}\n`;
                    }
                    alert(errorMsg);
                } else {
                    alert(`❌ Gagal menambahkan anggota: ${createData.message}`);
                }
                return;
            }

            newMemberId = createData.data.id_anggota;
            console.log("✅ User successfully created with ID:", newMemberId);

            // Upload Profile Picture (if selected)
            const fileInput = document.getElementById("profilePicture");
            if (fileInput.files.length > 0) {
                console.log("📸 Uploading profile picture...");
                const file = fileInput.files[0];
                const formData = new FormData();
                formData.append("profilePicture", file);

                const uploadResponse = await fetch(`http://localhost:8080/api/members/${newMemberId}/upload-profile-picture`, {
                    method: "POST",
                    headers: { "Authorization": `Bearer ${token}` },
                    body: formData
                });

                console.log("📩 Upload response:", uploadResponse);
                const uploadData = await uploadResponse.json();
                console.log("✅ Upload response data:", uploadData);

                if (!uploadResponse.ok) throw new Error(uploadData.message || "Gagal mengunggah foto.");

                console.log("🖼 Profile picture uploaded successfully:", uploadData.foto_url);
            }

            alert("✅ Anggota berhasil ditambahkan!");
            window.location.href = "<?= base_url('/anggota') ?>";

        } catch (error) {
            console.error("🚨 Error:", error);
            alert(`❌ Terjadi kesalahan: ${error.message}`);
        }
    });
});
</script>


<?= $this->endSection() ?>

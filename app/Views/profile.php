<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<body class="flex flex-col min-h-screen bg-gray-50">
    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto">
            <!-- Back to Dashboard -->
            <a href="<?= base_url('dashboard_user') ?>"  class="bg-gradient-to-b from-[#FA7C54] to-[#EC2C5A] text-white px-4 py-2 rounded-lg  items-center">
                ← Kembali ke Dashboard
            </a>

           <!-- Profile Picture Section -->
           <div class="flex flex-col items-center mb-8">
                <div class="relative">
                    <img id="profilePicture" 
                        src="<?= base_url('assets/img/Default.jpg') ?>" 
                        alt="Profile Picture" 
                        class="w-32 h-32 rounded-full object-cover mb-4 border border-gray-300 shadow-md">
                    
                    <!-- Edit Profile Picture Button -->
                    <button type="button" id="uploadPictureBtn" 
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
                    <label for="fullName" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" id="fullName" class="block w-full rounded-md border-gray-300 shadow-sm p-2 bg-gray-100" readonly>
                </div>

                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="username" class="block w-full rounded-md border-gray-300 shadow-sm p-2 bg-gray-100" readonly>
                </div>

                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                    <input type="text" id="gender" class="block w-full rounded-md border-gray-300 shadow-sm p-2 bg-gray-100" readonly>
                </div>

                <div>
                    <label for="level" class="block text-sm font-medium text-gray-700">Level</label>
                    <input type="text" id="level" class="block w-full rounded-md border-gray-300 shadow-sm p-2 bg-gray-100" readonly>
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea id="address" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm p-2 bg-gray-100" readonly></textarea>
                </div>
            </form>
        </div>
    </main>
</body>

<script>
const baseUrl = "<?= rtrim(base_url(), '/') ?>/";

document.addEventListener("DOMContentLoaded", async function () {
    const token = localStorage.getItem("token");
    const user = JSON.parse(localStorage.getItem("user"));

    if (!token || !user || !user.id) {
        window.location.href = baseUrl + "login-user";
        return;
    }

    const apiUrl = `${baseUrl}api/members/${user.id}`;

    try {
        const response = await fetch(apiUrl, {
            method: "GET",
            headers: { "Authorization": `Bearer ${token}`, "Content-Type": "application/json" }
        });

        if (!response.ok) throw new Error("Failed to fetch user data");

        const data = await response.json();

        document.getElementById("fullName").value = data.nama_anggota;
        document.getElementById("username").value = data.username || data.email || ""; 
        document.getElementById("gender").value = data.jk_anggota;
        document.getElementById("level").value = data.level_anggota;
        document.getElementById("address").value = data.alamat_anggota;

        if (data.foto_url) {
            document.getElementById("profilePicture").src = data.foto_url;
        }

    } catch (error) {
        console.error("Profile fetch error:", error);
        alert("Gagal mengambil data profil.");
    }
});

// Handle Profile Picture Upload
document.getElementById("uploadPictureBtn").addEventListener("click", function(e) {
    e.preventDefault(); // Prevent any default behavior
    e.stopPropagation(); // Stop event bubbling
    
    console.log("Upload button clicked"); // Debug logging
    
    const input = document.createElement("input");
    input.type = "file";
    input.accept = "image/*";

    input.onchange = async function(event) {
        const file = event.target.files[0];
        if (!file) return;
        
        console.log("File selected:", file.name); // Debug logging

        const formData = new FormData();
        formData.append("profilePicture", file);

        const user = JSON.parse(localStorage.getItem("user"));
        const token = localStorage.getItem("token");
        const apiUrl = `${baseUrl}api/members/${user.id}/upload-profile-picture`;

        try {
            console.log("Sending request to:", apiUrl); // Debug logging
            
            const response = await fetch(apiUrl, {
                method: "POST",
                headers: { 
                    "Authorization": `Bearer ${token}`
                    // Don't set Content-Type when sending FormData
                },
                body: formData
            });

            console.log("Response status:", response.status); // Debug logging
            
            const data = await response.json();
            console.log("Upload Response:", data);

            if (!response.ok || !data.foto_url) {
                throw new Error(data.message || "Upload failed.");
            }

            // Update profile picture preview
            document.getElementById("profilePicture").src = data.foto_url + "?t=" + new Date().getTime(); // Add timestamp to prevent caching
            alert("Profile picture uploaded successfully!");

        } catch (error) {
            console.error("Upload error:", error);
            alert("Error uploading profile picture: " + error.message);
        }
    };

    // Trigger file dialog
    input.click();
});
</script>

<?= $this->endSection() ?>
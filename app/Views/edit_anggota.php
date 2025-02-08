<?= $this->extend('layouts/main_admin') ?>
<?= $this->section('content') ?>

<body class="bg-gray-100 flex flex-col w-full h-full">
        <!-- Main Content -->
        <div class="flex-1 p-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8 p-4">
                <h1 class="text-2xl font-bold bg-gradient-to-b from-[#EC2C5A] to-[#FA7C54] bg-clip-text text-transparent">Edit Anggota</h1>
                <button id="closeBtn" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Edit Member Form -->
            <div class="bg-white rounded-lg shadow-lg p-6 max-w-3xl mx-auto">
                <form id="editMemberForm" class="space-y-6">
                    <!-- Profile Photo -->
                    <div class="flex justify-center">
                        <div class="relative">
                            <img id="memberPhoto" src="/api/placeholder/120/120" alt="Member photo" class="w-32 h-32 rounded-full object-cover">
                        </div>
                    </div>

                    <!-- Form Fields -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ID Anggota</label>
                            <input type="text" id="memberId" class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 shadow-sm" readonly>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" id="memberName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Username</label>
                            <input type="text" id="username" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" id="memberPassword" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                            <div class="mt-2 space-y-2">
                                <div class="flex items-center">
                                    <input type="radio" name="gender" value="P" class="focus:ring-red-500 h-4 w-4 text-red-600 border-gray-300">
                                    <label class="ml-3 block text-sm text-gray-700">Perempuan</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" name="gender" value="L" class="focus:ring-red-500 h-4 w-4 text-red-600 border-gray-300">
                                    <label class="ml-3 block text-sm text-gray-700">Laki-laki</label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Level</label>
                            <select id="memberLevel" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
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
                            <textarea id="memberAddress" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500" rows="3"></textarea>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-4">
                        <a href="/anggota" id="cancelBtn" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                            Batal
                        </a>
                        <button type="submit" class="bg-gradient-to-b from-[#FA7C54] to-[#EC2C5A] text-white px-6 py-2 rounded-lg hover:opacity-90 transition-opacity">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
document.addEventListener("DOMContentLoaded", function(){
    let userData = localStorage.getItem('user');
    let token = localStorage.getItem('token');
    
    const urlParams = new URLSearchParams(window.location.search);
    const memberId = urlParams.get('id');
    
    console.log("🛠 Token:", token);
    console.log("🆔 Member ID:", memberId);

    if (userData){
        let user = JSON.parse(userData);
        console.log("👤 User Data:", user);
    }

    if(token && memberId){
        fetchMemberData(memberId, token);
        fetchProfilePicture(memberId, token);
    } else {
        console.warn('⚠️ Token atau MemberId tidak ditemukan.');
    }

    document.getElementById('editMemberForm').addEventListener("submit", function(event) {
        updateMember(event, memberId, token);
    });

    document.getElementById('editPhotoBtn').addEventListener("click", function(){
        handleProfilePictureUpload(memberId, token);
    });
});

// 🟢 Fetch Member Data
async function fetchMemberData(memberId, token) {
    console.log(`📡 Fetching member data for ID: ${memberId}`);
    try {
        const response = await fetch(`http://localhost:8080/api/members/${memberId}`, {
            method: "GET",
            headers: {
                "Authorization": `Bearer ${token}`,
                "Content-Type": "application/json"
            }
        });

        console.log("📩 API Response:", response);

        if (!response.ok) {
            throw new Error(`❌ HTTP error! status: ${response.status}`);
        }

        const result = await response.json();
        console.log("✅ Member Data:", result);
        populateForm(result);
    } catch (error) {
        console.error("🚨 Error fetching member data:", error);
        alert("❌ Gagal mengambil data anggota. Silakan coba lagi.");
    }
}

// 🟢 Fetch Profile Picture with Better Error Handling
async function fetchProfilePicture(memberId, token) {
    console.log(`📡 Fetching profile picture for ID: ${memberId}`);
    const imgElement = document.getElementById('memberPhoto');
    
    // Set default image and properties
    imgElement.onerror = function() {
        this.src = '/api/placeholder/120/120';
        this.onerror = null; // Prevent infinite loop
    };

    try {
        const response = await fetch(`http://localhost:8080/api/members/${memberId}/profile-picture`, {
            method: "GET",
            headers: {
                "Authorization": `Bearer ${token}`
            }
        });

        if (!response.ok) {
            throw new Error(`Failed to fetch profile picture: ${response.status}`);
        }

        const result = await response.json();
        console.log("🖼 Profile Picture Data:", result);

        if (result.foto_url) {
            // Create a temporary image to verify the URL
            const tempImg = new Image();
            tempImg.onload = function() {
                imgElement.src = result.foto_url;
            };
            tempImg.onerror = function() {
                console.error("Failed to load image from URL:", result.foto_url);
                imgElement.src = '/api/placeholder/120/120';
            };
            tempImg.src = result.foto_url;
        } else {
            imgElement.src = '/api/placeholder/120/120';
        }
    } catch (error) {
        console.error("🚨 Error with profile picture:", error);
        imgElement.src = '/api/placeholder/120/120';
    }
}

// 🟢 Simplified Profile Picture Upload
function handleProfilePictureUpload(memberId, token) {
    console.log("📸 Initializing profile picture upload...");

    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';

    input.onchange = async function(event) {
        const file = event.target.files[0];
        if (!file) return;

        const imgElement = document.getElementById('memberPhoto');
        const formData = new FormData();
        formData.append('profilePicture', file);

        try {
            // Show loading state
            const originalSrc = imgElement.src;
            imgElement.src = '/api/placeholder/120/120';

            const response = await fetch(`http://localhost:8080/api/members/${memberId}/upload-profile-picture`, {
                method: "POST",
                headers: {
                    "Authorization": `Bearer ${token}`
                },
                body: formData
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'Upload failed');
            }

            if (result.foto_url) {
                // Verify the new image URL works
                const tempImg = new Image();
                tempImg.onload = function() {
                    imgElement.src = result.foto_url;
                    alert("✅ Foto profil berhasil diperbarui!");
                };
                tempImg.onerror = function() {
                    imgElement.src = originalSrc;
                    throw new Error('Failed to load uploaded image');
                };
                tempImg.src = result.foto_url;
            } else {
                throw new Error('No image URL in response');
            }
        } catch (error) {
            console.error("🚨 Error:", error);
            alert("❌ Gagal mengunggah foto. Silakan coba lagi.");
            imgElement.src = '/api/placeholder/120/120';
        }
    };

    input.click();
}

// Update the populateForm function to handle images better
function populateForm(data) {
    console.log("🔄 Populating form with data:", data);

    document.getElementById('memberId').value = data.id_anggota;
    document.getElementById('memberName').value = data.nama_anggota;
    document.getElementById('username').value = data.username;
    document.getElementById('memberPassword').value = "";
    document.querySelector(`input[name="gender"][value="${data.jk_anggota}"]`).checked = true;
    document.getElementById('memberLevel').value = data.level_anggota;
    document.getElementById('memberAddress').value = data.alamat_anggota;

    // Handle profile picture
    const imgElement = document.getElementById('memberPhoto');
    if (data.foto_url) {
        const tempImg = new Image();
        tempImg.onload = function() {
            imgElement.src = data.foto_url;
        };
        tempImg.onerror = function() {
            imgElement.src = '/api/placeholder/120/120';
        };
        tempImg.src = data.foto_url;
    } else {
        imgElement.src = '/api/placeholder/120/120';
    }
}
// 🟢 Update Member Data (PUT)
async function updateMember(event, memberId, token) {
    event.preventDefault();
    console.log("🛠 Updating member ID:", memberId);
    
    const memberData = {
        id_anggota: document.getElementById('memberId').value.trim(),
        nama_anggota: document.getElementById('memberName').value.trim(),
        username: document.getElementById('username').value.trim(),
        password: document.getElementById('memberPassword').value.trim(),
        jk_anggota: document.querySelector('input[name="gender"]:checked').value.trim(),
        level_anggota: document.getElementById('memberLevel').value.trim(),
        alamat_anggota: document.getElementById('memberAddress').value.trim()
    };

    console.log("📡 Sending Update Data:", memberData);

    try {
        const response = await fetch(`http://localhost:8080/api/members/${memberId}`, {
            method: "PUT",
            headers: {
                "Authorization": `Bearer ${token}`,
                "Content-Type": "application/json"
            },
            body: JSON.stringify(memberData)
        });

        const result = await response.json();
        console.log("📩 Update Response:", result);

        if (response.ok) {
            alert("✅ Member berhasil diperbarui!");
            document.getElementById('editMemberForm').reset();
            window.location.href = "<?= base_url('/anggota') ?>";
        } else {
            console.error("🚨 Update Failed:", result);
            alert(`❌ Gagal mengupdate member: ${JSON.stringify(result)}`);
        }
    } catch (error) {
        console.error("🚨 Error updating member:", error);
        alert("❌ Gagal mengupdate member. Silakan coba lagi.");
    }
}


</script>



<?= $this->endSection() ?>
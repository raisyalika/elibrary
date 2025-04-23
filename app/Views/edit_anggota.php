<?= $this->extend('layouts/main_admin') ?>
<?= $this->section('content') ?>

<body class="bg-gray-100 flex flex-col w-full h-full">
    <!-- Main Content -->
    <div class="flex-1 p-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8 p-4">
            <h1 class="text-2xl font-bold bg-gradient-to-b from-[#EC2C5A] to-[#FA7C54] bg-clip-text text-transparent">Edit Anggota</h1>

        </div>

        <!-- Edit Member Form -->
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-3xl mx-auto">
            <form id="editMemberForm" class="space-y-6">
                <!-- Profile Photo -->
                <div class="flex justify-center">
                    <div class="relative">
                        <img id="memberPhoto" src="<?= base_url('assets/img/Default.jpg') ?>" class="w-32 h-32 rounded-full object-cover">
                    </div>
                </div>

                <!-- Form Fields -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">ID Anggota</label>
                        <input type="text" id="memberId" class="w-full p-2 rounded-md border shadow-sm" readonly>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" id="memberName" class="w-full p-2 rounded-md border shadow-sm focus:border-red-500 focus:ring-red-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" id="username" class="w-full p-2 rounded-md border shadow-sm focus:border-red-500 focus:ring-red-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="memberPassword" class="w-full p-2 rounded-md border shadow-sm focus:border-red-500 focus:ring-red-500">
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
                        <select id="memberLevel" class="w-full p-2 rounded-md border shadow-sm focus:border-red-500 focus:ring-red-500">
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
                        <textarea id="memberAddress" class="w-full p-2 rounded-md border shadow-sm focus:border-red-500 focus:ring-red-500" rows="3"></textarea>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="pt-4 flex flex-col sm:flex-row sm:justify-end sm:space-x-4">
                    <a href="<?= base_url('anggota') ?>" id="cancelBtn" class="flex-1 text-center border border-gray-300 text-gray-700 text-sm font-medium rounded-lg py-1.5 hover:bg-gray-50 hover:opacity-90 transition">
                        Batal
                    </a>
                    <button type="submit" class="flex-1 bg-gradient-to-r from-[#FA7C54] to-[#EC2C5A] text-white text-sm py-1.5 rounded-lg hover:opacity-90 transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>
</body>
<script>
    const baseURL = '<?= base_url() ?>';
    document.addEventListener("DOMContentLoaded", function() {
        console.log("🟢 DOMContentLoaded event fired");

        let userData = localStorage.getItem('user');
        let token = localStorage.getItem('token');

        // Debug logging
        console.log('🔍 Initial values:', {
            baseURL,
            hasUserData: !!userData,
            hasToken: !!token
        });

        const urlParams = new URLSearchParams(window.location.search);
        const memberId = urlParams.get('id');

        console.log('🔍 URL params:', {
            memberId,
            fullURL: window.location.href
        });

        if (userData) {
            let user = JSON.parse(userData);
            console.log('🔍 Parsed user data:', user);
        }

        if (token && memberId) {
            console.log('✅ Conditions met, attempting to fetch data...');
            fetchMemberData(memberId, token);
            fetchProfilePicture(memberId, token);
        } else {
            console.warn('⚠️ Token atau MemberId tidak ditemukan:', {
                token: !!token,
                memberId: !!memberId
            });
        }

        // Check if form exists
        const form = document.getElementById('editMemberForm');
        if (form) {
            console.log('✅ Form found, adding submit listener');
            form.addEventListener("submit", function(event) {
                updateMember(event, memberId, token);
            });
        } else {
            console.error('❌ Form element not found!');
        }

        // Check if photo button exists
        const photoBtn = document.getElementById('editPhotoBtn');
        if (photoBtn) {
            console.log('✅ Photo button found, adding click listener');
            photoBtn.addEventListener("click", function() {
                handleProfilePictureUpload(memberId, token);
            });
        } else {
            console.error('❌ Photo button element not found!');
        }
    });

    // Modify fetchMemberData with more logging
    async function fetchMemberData(memberId, token) {
        const url = `${baseURL}api/members/${memberId}`;
        console.log('🔍 Attempting fetch:', {
            url,
            hasToken: !!token,
            memberId
        });

        try {
            const response = await fetch(url, {
                method: "GET",
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Content-Type": "application/json"
                }
            });

            console.log('🔍 Response received:', {
                status: response.status,
                ok: response.ok,
                statusText: response.statusText
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            console.log('✅ Data received:', result);
            populateForm(result);
        } catch (error) {
            console.error("🚨 Detailed error:", {
                message: error.message,
                error: error
            });
            alert("❌ Gagal mengambil data anggota. Silakan coba lagi.");
        }
    }
    async function fetchProfilePicture(memberId, token) {
        const imgElement = document.getElementById('memberPhoto');
        const defaultImage = `${baseURL}assets/img/Default.jpg`; // ✅ Match your base URL

        imgElement.onerror = function() {
            console.warn("⚠️ Image failed to load, switching to default");
            this.src = defaultImage;
            this.onerror = null; // prevent infinite loop
        };

        try {
            const response = await fetch(`${baseURL}api/members/${memberId}/profile-picture`, {
                method: "GET",
                headers: {
                    "Authorization": `Bearer ${token}`
                }
            });

            const result = await response.json();

            if (result.foto_url && result.foto_url.trim() !== "") {
                console.log("✅ Fetched profile picture URL:", result.foto_url);
                imgElement.src = result.foto_url;
            } else {
                console.warn("⚠️ No foto_url in response, reverting to default image");
                imgElement.src = defaultImage;
            }
        } catch (error) {
            console.error("🚨 Error fetching profile picture:", error);
            imgElement.src = defaultImage;
        }
    }

    function handleProfilePictureUpload(memberId, token) {
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
                imgElement.src = '/api/placeholder/120/120';

                const response = await fetch(`${baseURL}api/members/${memberId}/upload-profile-picture`, { // ✅ Changed localhost to baseURL
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
                    imgElement.src = result.foto_url;
                    alert("✅ Foto profil berhasil diperbarui!");
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

    function populateForm(data) {
        console.log("🔄 Populating form with data:", data);

        document.getElementById('memberId').value = data.id_anggota;
        document.getElementById('memberName').value = data.nama_anggota;
        document.getElementById('username').value = data.username;
        document.getElementById('memberPassword').value = "";
        document.querySelector(`input[name="gender"][value="${data.jk_anggota}"]`).checked = true;
        document.getElementById('memberLevel').value = data.level_anggota;
        document.getElementById('memberAddress').value = data.alamat_anggota;

        // Handle profile picture with null/empty check
        const imgElement = document.getElementById('memberPhoto');
        const defaultImage = `${baseURL}assets/img/Default.jpg`; // ✅ Set your default path here!

        if (data.foto_url && data.foto_url.trim() !== "") {
            console.log("✅ Valid foto_url found:", data.foto_url);
            imgElement.src = data.foto_url;
        } else {
            console.warn("⚠️ No foto_url found, using default image");
            imgElement.src = defaultImage;
        }
    }
</script>



<?= $this->endSection() ?>
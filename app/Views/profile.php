<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - E-Library SDN Jelambar Baru 07</title>
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet"></head>

</head>
<body class="flex flex-col min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="bg-orange-500 text-white sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <img src="assets/img/logo.png" alt="Logo" class="w-10 h-10">
                <h1 class="text-xl font-bold">E-Library SDN Jelambar Baru 07</h1>
            </div>
            <div class="space-x-4">
                <a href="#" class="hover:underline">Profil</a>
                <a href="#" class="hover:underline">Keluar</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto">
            <!-- Profile Picture Section -->
            <div class="flex flex-col items-center mb-8">
                <div class="relative">
                    <img id="profilePicture" 
                        src="assets/img/profile.jpg" 
                        alt="Profile Picture" 
                        class="w-32 h-32 rounded-full object-cover mb-4">
                    <button id="editPhotoBtn" 
                            class="absolute bottom-4 right-0 bg-orange-500 text-white p-2 rounded-full hover:bg-orange-600 shadow-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </button>
                </div>
                <button id="editPictureBtn" class="text-orange-500 text-sm font-medium">
                    Edit Foto
                </button>
            </div>

            <!-- Profile Form -->
            <form id="profileForm" class="space-y-6">
                <!-- ID Anggota -->
                <div>
                    <label for="memberId" class="block text-sm font-medium text-gray-700">ID Anggota</label>
                    <input type="text" 
                          id="memberId" 
                          name="memberId" 
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 bg-gray-100" 
                          readonly>
                </div>

                <!-- Nama Lengkap -->
                <div>
                    <label for="fullName" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" 
                          id="fullName" 
                          name="fullName" 
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2">
                        <button type="button" 
                                id="togglePassword" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                    <select id="gender" 
                            name="gender" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <!-- Level -->
                <div>
                    <label for="level" class="block text-sm font-medium text-gray-700">Level</label>
                    <select id="level" 
                            name="level" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2">
                        <option value="Kelas 1">Kelas 1</option>
                        <option value="Kelas 2">Kelas 2</option>
                        <option value="Kelas 3">Kelas 3</option>
                        <option value="Kelas 4">Kelas 4</option>
                        <option value="Kelas 5">Kelas 5</option>
                        <option value="Kelas 6">Kelas 6</option>
                    </select>
                </div>

                <!-- Alamat -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea id="address" 
                              name="address" 
                              rows="3" 
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2"></textarea>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-orange-100 mt-auto py-4">
        <div class="container mx-auto text-center">
            <h2 class="font-bold mb-2">E-Library SDN Jelambar Baru 07</h2>
            <p class="text-sm text-gray-600">© Copyright 2025 SDN Jelambar Baru 07</p>
        </div>
    </footer>

    <script>
        // Fetch user profile data
        async function fetchUserProfile() {
            try {
                // Replace with your actual API endpoint
                const response = await fetch('your-api-endpoint/profile');
                const data = await response.json();
                
                // Populate form fields
                document.getElementById('memberId').value = data.memberId;
                document.getElementById('fullName').value = data.fullName;
                document.getElementById('password').value = data.password;
                document.getElementById('gender').value = data.gender;
                document.getElementById('level').value = data.level;
                document.getElementById('address').value = data.address;
                
                // Update profile picture if available
                if (data.profilePicture) {
                    document.getElementById('profilePicture').src = data.profilePicture;
                }
            } catch (error) {
                console.error('Error fetching profile:', error);
            }
        }

        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle eye icon
            this.innerHTML = type === 'password' 
                ? '<svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>'
                : '<svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>';
        });

        // Handle profile picture upload
        document.getElementById('editPictureBtn').addEventListener('click', function() {
            // Create file input
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            
            input.onchange = async function(e) {
                const file = e.target.files[0];
                if (file) {
                    // Handle file upload to server
                    const formData = new FormData();
                    formData.append('profilePicture', file);
                    
                    try {
                        // Replace with your actual upload endpoint
                        const response = await fetch('your-api-endpoint/upload-profile-picture', {
                            method: 'POST',
                            body: formData
                        });
                        
                        if (response.ok) {
                            const data = await response.json();
                            document.getElementById('profilePicture').src = data.profilePictureUrl;
                        }
                    } catch (error) {
                        console.error('Error uploading profile picture:', error);
                    }
                }
            };
            
            input.click();
        });

        // Load profile data when page loads
        fetchUserProfile();
    </script>
</body>
</html>
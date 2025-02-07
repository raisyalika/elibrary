<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Anggota</title>
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar (same as before) -->
        <div class="w-64 bg-white shadow-lg">
            <!-- Logo and Title -->
            <div class="p-4">
                <div class="flex items-center space-x-2">
                    <img src="assets/img/logo.png" alt="Logo" class="w-8 h-8">
                    <div>
                        <h1 class="text-lg font-semibold text-gray-800">E-Library SDN</h1>
                        <p class="text-sm text-gray-600">Jelambar Baru 07</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="mt-6">
                <a href="/beranda" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Beranda
                </a>

                <a href="/buku" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Buku
                </a>

                <a href="/anggota" class="flex items-center px-6 py-3 bg-gradient-to-b from-[#EC2C5A] to-[#FA7C54] text-white">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Anggota
                </a>

                <a href="#" class="flex items-center px-6 py-3 text-red-500 hover:bg-gray-100 mt-auto">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Keluar
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
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
                        <button type="button" id="cancelBtn" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                            Batal
                        </button>
                        <button type="submit" class="bg-gradient-to-b from-[#FA7C54] to-[#EC2C5A] text-white px-6 py-2 rounded-lg hover:opacity-90 transition-opacity">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Function to fetch member data
        async function fetchMemberData(memberId) {
            try {
                const response = await fetch(`/api/members/${memberId}`);
                if (!response.ok) throw new Error('Failed to fetch member data');
                const data = await response.json();
                
                // Populate form fields
                document.getElementById('memberId').value = data.id;
                document.getElementById('memberName').value = data.name;
                document.getElementById('memberAddress').value = data.address;
                document.getElementById('memberLevel').value = data.level;
                
                // Set gender radio button
                const genderInputs = document.getElementsByName('gender');
                for (let input of genderInputs) {
                    if (input.value === data.gender) {
                        input.checked = true;
                    }
                }

                // Set profile photo if available
                if (data.photo) {
                    document.getElementById('memberPhoto').src = data.photo;
                }
            } catch (error) {
                console.error('Error fetching member data:', error);
            }
        }

        // Handle form submission
        document.getElementById('editMemberForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const formData = new FormData();
            formData.append('id', document.getElementById('memberId').value);
            formData.append('name', document.getElementById('memberName').value);
            formData.append('password', document.getElementById('memberPassword').value);
            formData.append('gender', document.querySelector('input[name="gender"]:checked').value);
            formData.append('level', document.getElementById('memberLevel').value);
            formData.append('address', document.getElementById('memberAddress').value);

            try {
                const response = await fetch('/api/members/update', {
                    method: 'POST',
                    body: formData
                });

                if (!response.ok) throw new Error('Failed to update member');
                
                // Handle successful update
                window.location.href = '/anggota';
            } catch (error) {
                console.error('Error updating member:', error);
            }
        });

        // Handle cancel button
        document.getElementById('cancelBtn').addEventListener('click', () => {
            window.location.href = '/anggota';
        });

        // Handle close button
        document.getElementById('closeBtn').addEventListener('click', () => {
            window.location.href = '/anggota';
        });

        // Fetch member data when page loads
        // You would typically get the member ID from the URL or passed parameter
        const urlParams = new URLSearchParams(window.location.search);
        const memberId = urlParams.get('id');
        if (memberId) {
            fetchMemberData(memberId);
        }
    </script>
</body>
</html>
<?= $this->extend('layouts/main_admin') ?>
<?= $this->section('content') ?>

<main class="flex-1 p-4 md:p-8">
    <!-- Header -->
    <div class="flex justify-end mb-4 md:mb-8">
        <span id="userName" class="text-gray-600"></span>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
        <!-- Koleksi Card -->
        <div class="bg-white rounded-lg shadow p-6 flex items-center">
            <div class="p-3 rounded-lg bg-red-500">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <div class="ml-4">
                <h2 id="jumlah_buku" class="text-4xl font-bold"></h2>
                <p class="text-gray-600">Koleksi</p>
            </div>
        </div>

        <!-- Anggota Card -->
        <div class="bg-white rounded-lg shadow p-6 flex items-center">
            <div class="p-3 rounded-lg bg-red-500">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <div class="ml-4">
                <h2 id="jumlah_anggota" class="text-4xl font-bold"></h2>
                <p class="text-gray-600">Anggota</p>
            </div>
        </div>

        <!-- Kategori Card -->
        <div class="bg-white rounded-lg shadow p-6 flex items-center">
            <div class="p-3 rounded-lg bg-red-500">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </div>
            <div class="ml-4">
                <h2 id="jumlah_admin" class="text-4xl font-bold"></h2>
                <p class="text-gray-600">Admin</p>
            </div>
        </div>
    </div>
</main>

<script>
    // Define the base URL using the PHP variable.
    // Make sure that $baseURL is set in your controller and passed to the view.
   const baseUrl = "<?= base_url() ?>";

    document.addEventListener("DOMContentLoaded", function () {
        let userData = localStorage.getItem("user"); 
        let token = localStorage.getItem("token");

        if (userData) {
            // Parse the JSON string into an object.
            let user = JSON.parse(userData);
        
            // Get the element to display the user's name.
            let nameElement = document.getElementById("userName");

            // Set the user's name in the element.
            nameElement.textContent = user.name;
            console.log("User:", user);
        } else {
            console.warn("User data not found in localStorage.");
        }

        // Log the entire localStorage for debugging.
        console.log("localStorage contents:", localStorage);

        if (token) {
            fetchBook(token);
            fetchMembers(token);
            fetchAdmins(token);
        } else {
            console.warn("Token not found in localStorage.");
        }
    });

    function fetchBook(token) {
        fetch(baseUrl + "api/books", {
            method: "GET",
            headers: {
                "Authorization": "Bearer " + token,
                "Content-Type": "application/json" 
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Error fetching books: " + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log("Book data: ", data);
            
            let jumlah_buku = data.data.length;
            let jumlah_buku_element = document.getElementById("jumlah_buku");
            jumlah_buku_element.textContent = jumlah_buku;
            console.log(jumlah_buku);
        })
        .catch(error => {
            console.error("Error fetching books:", error);
        });
    }

    function fetchMembers(token) {
        fetch(baseUrl + "api/members", {
            method: "GET",
            headers: {
                "Authorization": "Bearer " + token,
                "Content-Type": "application/json"
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Error fetching members: " + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log("Member data:", data);

            let jumlah_anggota = data.data.length;
            let jumlah_anggota_element = document.getElementById("jumlah_anggota");
            if (jumlah_anggota_element) {
                jumlah_anggota_element.textContent = jumlah_anggota;
            } else {
                console.warn("Element with id 'jumlah_anggota' not found.");
            }
        })
        .catch(error => {
            console.error("Error fetching members:", error);
        });
    }

    function fetchAdmins(token) {
        fetch(baseUrl + "api/admins", {
            method: "GET",
            headers: {
                "Authorization": "Bearer " + token,
                "Content-Type": "application/json"
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Error fetching admins: " + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log("Admin data:", data);
            let jumlah_admin = data.data.length;
            let jumlah_admin_element = document.getElementById("jumlah_admin");
            if (jumlah_admin_element) {
                jumlah_admin_element.textContent = jumlah_admin;
            } else {
                console.warn("Element with id 'jumlah_admin' not found.");
            }
        })
        .catch(error => {
            console.error("Error fetching admins:", error);
        });
    }
</script>

<?= $this->endSection() ?>

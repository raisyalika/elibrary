<?php ?>
<header class="bg-orange-500 text-white sticky top-0 z-50">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <!-- Logo & Title -->
        <div class="flex items-center space-x-2">
            <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo" class="w-10 h-10">
            <h1 class="text-lg font-bold">E-Library SDN Jelambar Baru 07</h1>
        </div>

        <!-- Navigation -->
        <nav id="nav-links" class="flex space-x-4"></nav>
    </div>
    <div id="logoutModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Konfirmasi Keluar</h2>
            <p class="text-gray-600 mb-4">Apakah Anda yakin ingin Keluar?</p>
            <div class="flex justify-end space-x-4">
                <button id="cancelLogout" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                <button id="confirmLogout" class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600">Ya, Saya yakin</button>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let navLinks = document.getElementById("nav-links");
        let token = localStorage.getItem("token");

        // Function to decode JWT token
        function parseJwt(token) {
            try {
                const base64Url = token.split(".")[1];
                const base64 = base64Url.replace(/-/g, "+").replace(/_/g, "/");
                const jsonPayload = decodeURIComponent(
                    atob(base64)
                    .split("")
                    .map((c) => "%" + ("00" + c.charCodeAt(0).toString(16)).slice(-2))
                    .join("")
                );
                return JSON.parse(jsonPayload);
            } catch (error) {
                console.error("Invalid token:", error);
                return null;
            }
        }

        if (token) {
            const decodedToken = parseJwt(token);
            if (!decodedToken || decodedToken.role !== "member") {
                window.location.href = "<?= base_url('login') ?>"; // Redirect if not member
            }
        } else {
            window.location.href = "<?= base_url('login') ?>"; // Redirect if no token
        }

        // Generate navigation menu based on login status
        function generateNavLinks() {
            if (token) {
                return `
                <a href="<?= base_url('profile') ?>" class="hover:underline self-center px-4 py-2">Profil</a>
                <a href="#" id="logoutButton"  class="hover:underline text-white  px-4 py-2 rounded-lg items-center">Keluar</a>
            `;
            } else {
                return `
                <a href="<?= base_url('login') ?>" class="hover:underline">Masuk</a>
                <a href="<?= base_url('register') ?>" class="hover:underline">Daftar</a>
            `;
            }
        }

        navLinks.innerHTML = generateNavLinks();

        // Logout Modal
        const logoutModal = document.getElementById("logoutModal");
        const logoutButton = document.getElementById("logoutButton");
        const confirmLogout = document.getElementById("confirmLogout");
        const cancelLogout = document.getElementById("cancelLogout");

        if (logoutButton) {
            logoutButton.addEventListener("click", (e) => {
                e.preventDefault();
                logoutModal.classList.remove("hidden");
            });
        }

        cancelLogout.addEventListener("click", () => {
            logoutModal.classList.add("hidden");
        });

        confirmLogout.addEventListener("click", () => {
            localStorage.removeItem("token");
            window.location.href = "<?= base_url('login-user') ?>"; // Redirect to login page
        });
    });
</script>
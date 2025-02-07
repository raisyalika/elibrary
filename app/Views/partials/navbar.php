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
</header>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let navLinks = document.getElementById("nav-links");
        let token = localStorage.getItem("token");
        let user = localStorage.getItem("user");

        if (token && user) {
            // User is logged in
            navLinks.innerHTML = `
                <a href="<?= base_url('profile') ?>" class="hover:underline">Profil</a>
                <a href="#" onclick="logout()" class="hover:underline">Keluar</a>
            `;
        } else {
            // User is not logged in
            navLinks.innerHTML = `
                <a href="<?= base_url('login') ?>" class="hover:underline">Masuk</a>
                <a href="<?= base_url('register') ?>" class="hover:underline">Daftar</a>
            `;
        }
    });

    function logout() {
        localStorage.removeItem("token");
        localStorage.removeItem("user");
        alert("Anda telah logout.");
        window.location.href = "<?= base_url('login-user') ?>";
    }
</script>
